<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Modules\Admin\Entities\Role;
use Modules\Admin\Entities\User;
use Modules\Admin\Http\Requests\StoreUserRequest;
use Modules\Admin\Http\Requests\UpdateUserRequest;
use Modules\Admin\Repositories\PermissionRepository;
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

    public function generalInfoTab(Request $request, User $user){
        $roles = Role::pluck('name', 'id');
        $activate = (Activation::completed($user)) ? true : false;
        return View::make('admin::users.general-info',compact('user','roles','activate'))->render();
    }

    public function changePasswordTab(Request $request,  User $user){
        return View::make('admin::users.change-password-tab', compact('user'))->render();
    }

    public function permissionsTab(Request $request, User $user, PermissionRepository $permissionRepository){
        $permissions = $permissionRepository->getPermissionsGroupped();
        $selected_permissions = collect($user->getPermissions())->map(function($p,$k){
            return $k;
        });
        return View::make('admin::users.permissions-tab', compact('user','permissions','selected_permissions'))->render();
    }

    public function permissionsTabPost(Request $request, User $user, PermissionRepository $permissionRepository){
        if ($request->permissions) {
            $user->permissions = $permissionRepository->getPermissionsFromGroup($request->permissions);
            try{
                $user->save();
            }catch (\Exception $exception){
                return response()->json([
                    'success'=> false
                ]);
            }
        }

        return response()->json([
            'success'=> true
        ]);
    }

    public function changePassword(Request $request, User $user){
        $this->validate($request, [
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required_if:password,present',
        ]);

        try{
            Sentinel::update($user , $request->only('password'));//if password changes
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
            ]);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function create(Request $request, PermissionRepository $permissionRepository){
        $roles = Role::pluck('name', 'id');
        $permissions = $permissionRepository->getPermissionsGroupped();

        return View::make('admin::users.quick-create')->with(['roles'=>$roles])->render();
    }

    public function store(StoreUserRequest $request){
        $activate = $request->activate ? true : false;

        try{
            $user = Sentinel::register($request->all() , $activate);
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong'
            ]);
        }

        if ($request->roles) {
            $user->roles()->sync($request->roles);
        }

        $user = User::find($user->id);

        return response()->json([
           'success' => true,
           'newData' => $user
        ]);
    }

    public function edit(User $user, PermissionRepository $permissionRepository){
        $roles = Role::pluck('name', 'id');
        $permissions = $permissionRepository->getPermissionsGroupped();
        $activate = (Activation::completed($user)) ? true : false;
        $selected_permissions = collect($user->getPermissions())->map(function($p,$k){
            return $k;
        });

        return view('admin::users.edit', compact('user','roles','permissions','activate','selected_permissions'));
    }

    public function quickUpdate(UpdateUserRequest $request, User $user){

        $activate = $request->has('activate') ? true : false;

        $user->update($request->except(['password', 'password_confirmation']));

        $user->roles()->sync($request->roles);

        if ($request->permissions) {
            $user->permissions = $this->permissionRepository->getPermissionsFromGroup($request->permissions);
            $user->save();
        }

        if ($request->password) {
            Sentinel::update($user , $request->only('email','password'));//if password changes
        }

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

        return response()->json([
            'success' => true,
            'newData' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user){
        $activate = $request->has('activate') ? true : false;

        $user->update($request->except(['password', 'password_confirmation']));

        $user->roles()->sync($request->roles);

        if ($request->permissions) {
            $user->permissions = $this->permissionRepository->getPermissionsFromGroup($request->permissions);
            $user->save();
        }

        if ($request->password) {
            Sentinel::update($user , $request->only('email','password'));//if password changes
        }

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

        return response()->json([
            'success' => true,
        ]);
    }

    public function delete(Request $request){

        if ($request->input('id')){
            $user = User::find($request->input('id'));
            $user->delete();
        }

        return response()->json([
            'success' => 'success',
        ]);
    }
}
