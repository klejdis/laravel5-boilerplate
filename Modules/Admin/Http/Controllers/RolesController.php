<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\StoreRoleRequest;
use Modules\Admin\Repositories\PermissionRepository;
use Sentinel;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function __construct( PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(){
        return view('admin::roles.index')->with([
            'panel' => [
                'name' => __('admin::admin.Roles')
            ]
        ]);;
    }

    public function datatable(){
        $roles = Role::select(['id', 'name', 'created_at']);
        $datatables = Datatables::of($roles);

        //EDIT COLUMNS
        $datatables->editColumn('created_at',function($role){ return Carbon::parse($role->created_at)->format('d-m-Y H:i'); });

        //FILTERS
        return $datatables->rawColumns(['actions'])->make();
    }

    public function quickCreate(PermissionRepository $permissionRepository){
        $permissions = $permissionRepository->getPermissionsGroupped();
        return view('admin::roles.quick_create' , compact('permissions'));
    }

    public function create(PermissionRepository $permissionRepository){
        $permissions = $permissionRepository->getPermissionsGroupped();
        return view('admin::roles.quick_create' , compact('permissions'));
    }

    public function store(StoreRoleRequest $request , PermissionRepository $permissionRepository){
        try {
            $permissions = $permissionRepository->getPermissionsFromGroup($request->permissions);
            $role = Sentinel::getRoleRepository()->createModel()->create($request->only(['name','slug']));
            $role->permissions = $permissions;
            $role->save();
        } catch (\Illuminate\Database\QueryException $e){
            return response()->json([
                'success' => false,
                'message' => 'Dublicated Slug'
            ]);
        }

        return response()->json([
           'success' => true
        ]);
    }

    public function edit(Role $role){
        $routes = \Route::getRoutes();
        $permissions = $this->permissionRepository->getPermissionsGroupped();
        $selected_permissions = $selected_permissions = collect($role->getPermissions())->map(function($p,$k){
            return $k;
        });

        return view('backend.roles.edit', compact('role','permissions','selected_permissions'));
    }

    public function update(StoreRoleRequest $request, Role $role){
        try {
            $role->update($request->only(['name', 'slug']));
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with([
                'toastr' => json_encode([
                    'type' => 'error',
                    'message' => 'Dublicate Slug'
                ])
            ]);
        }
        if ($request->permissions) {
            $role->permissions = $this->permissionRepository->getPermissionsFromGroup($request->permissions);
            $role->save();
        }

        return redirect()->route('admin.roles.index');
    }

    public function delete(Role $role){
        $role->delete();
        return redirect()->route('admin.roles.index')->with([
            'toastr' => json_encode([
                'type' => 'success',
                'message' => 'Role Deleted Succesfully'
            ])
        ]);
    }

}
