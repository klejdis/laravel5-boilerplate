<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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
        return view('admin::users.index');
    }

    public function datatable(){
        $users = User::select(['id', 'first_name', 'last_name', 'email', 'created_at'])->with('roles','activations');
        $datatables = Datatables::of($users);

        //EDIT COLUMNS
        $datatables->editColumn('created_at',function($user){ return Carbon::parse($user->created_at)->format('d-m-Y H:i'); });
        //ACTIONS COLUMNS
        $datatables->addColumn('actions' , function($user){

            $actions_html = '<div class="btn-group btn-group-sm" role="group" aria-label="User Actions">';

            if (Sentinel::hasAccess('read-users')) {
                $actions_html .= ' <a href="'.route('admin.users.show', ['user' => $user->id]).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i></a>';
            }

            if (Sentinel::hasAccess('edit-users')) {
                $actions_html .= '<a href="'.route('admin.users.edit', ['user' => $user->id]).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>';
            }

            $actions_html .= '<div class="btn-group btn-group-sm" role="group">
								<button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More <i class="fa fa-sort-desc" aria-hidden="true"></i>
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							 ';
            if (Sentinel::hasAccess('delete-users')) {
                $actions_html .= '<li><a class="dropdown-item delete-btn"  data-id="'.$user->id.'" href="#">Delete</a></li>';
            }

            $actions_html .=  '</ul>
							  </div>
							</div>';

            return $actions_html;

        });

        //FILTERS

        return $datatables->rawColumns(['actions'])->make();
    }

    public function show(User $user){
        return view('backend.users.show',compact('user'));
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
