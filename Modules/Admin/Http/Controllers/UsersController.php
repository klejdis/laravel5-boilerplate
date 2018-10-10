<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Modules\Admin\Entities\User;
use Sentinel;
use Activation;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Users\UserInterface;


class UsersController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin::users.index')->with([
            'panel' => [
                'name' => __('admin::admin.Users')
            ]
        ]);
    }

    public function datatable(){
        $users = User::select(['id', 'first_name', 'last_name', 'email', 'created_at'])->with('roles','activations');
        $datatables = DataTables::of($users);
        //EDIT COLUMNS
        $datatables->editColumn('created_at',function($user){ return Carbon::parse($user->created_at)->format('d-m-Y H:i'); });
        //FILTERS
        return $datatables->rawColumns(['actions'])->make();
    }

    public function show(User $user){
        return view('admin::users.show', compact('user'));
    }

    public function create(){
        $roles = Role::pluck('name', 'id');
        $permissions = $this->permissionRepository->getPermissionsGroupped();

        return view('backend.users.create' , compact('roles' ,'permissions'));
    }

    public function store(StoreUserRequest $request){
        $activate = $request->activate ? true : false;
        $user = Sentinel::register($request->all() , $activate);


        if ($request->roles) {
            $user->roles()->sync($request->roles);
        }

        if ($request->permissions) {
            $user->permissions = $this->permissionRepository->getPermissionsFromGroup($request->permissions);
            $user->save();
        }

        //get the base-64 from data
        $base64_str = substr($request->input('gravatar'), strpos($request->input('gravatar'), ",")+1);

        //decode base64 string
        $image = base64_decode($base64_str);

        $public = 'public/';

        $save_dir = 'avatars/'.$user->id.'/';

        $image_name = 'profile_image_'.$user->id.'.png';

        Storage::put($public.$save_dir.$image_name, $image);

        $path = $save_dir.$image_name;

        $user->gravatar = $path;

        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user){
        $roles = Role::pluck('name', 'id');
        $permissions = $this->permissionRepository->getPermissionsGroupped();
        $activate = (Activation::completed($user)) ? true : false;
        $selected_permissions = collect($user->getPermissions())->map(function($p,$k){
            return $k;
        });
        //dd($selected_permissions);

        return view('backend.users.edit', compact('user','roles','permissions','activate','selected_permissions'));
    }

    public function update(UpdateUserRequest $request, User $user){

        $activate = $request->has('activate') ? true : false;

        //dd($activate);

        $user->update($request->except(['password', 'password_confirmation']));

        $user->roles()->sync($request->roles);

        if ($request->permissions) {
            $user->permissions = $this->permissionRepository->getPermissionsFromGroup($request->permissions);
            $user->save();
        }

        if ($request->password) {
            Sentinel::update($user , $request->only('email','password'));//if password changes
        }


        /*
         * Check if the user activation is checked
         * If so, then activate the user if the activation code doesnt exists
         * It it exists just update the complete to true
         * B.B
         *
         * */

        if ($activate == true){
            $user_activation = Activation::where('user_id',$user->id)->first();
            /*dd($user_activation);*/
            if ($user_activation){
                $user_activation->completed = true;
                $user_activation->update();
            }else{
                $activation = Activation::create($user);
                $complete = Activation::complete($user, $activation->code);
                if ($complete){
                    $activation = Activation::completed($user);
                }
            }
        }else if ($activate == false){
            $user_activation = Activation::where('user_id',$user->id)->first();
            if ($user_activation){
                $user_activation->completed = 0;
                $user_activation->update();
            }
        }

        //get the base-64 from data
        $base64_str = substr($request->input('gravatar'), strpos($request->input('gravatar'), ",")+1);

        //decode base64 string
        $image = base64_decode($base64_str);

        $public = 'public/';

        $save_dir = 'avatars/'.$user->id.'/';

        $image_name = 'profile_image_'.$user->id.'.png';

        Storage::put($public.$save_dir.$image_name, $image);

        $path = $save_dir.$image_name;

        $user->gravatar = $path;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function delete(User $user){
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}