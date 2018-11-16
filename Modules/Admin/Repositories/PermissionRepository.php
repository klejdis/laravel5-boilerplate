<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\Permission;

class PermissionRepository extends BaseRepository {

    public function model()
    {
        return Permission::class;
    }

    /**
     * GET PERMISSSION GROUPPED BY MODULE
     * @return array
     */
    public function getPermissionsGroupped(){
        $permissions = [];
        $this->all()->map(function($permission) use (&$permissions){
            if (!isset($permissions[$permission->module])){
                $permissions[$permission->module] = [];
            }
            $permissions[$permission->module][$permission->slug] = $permission->name;
        });
        return $permissions;
    }

    /**
     * GET PERMISSIONS ARRAY FOR SENTINEL TO BE STORED ON DB
     * @return array
     */

    public function getPermissionsFromGroup($permissions){
        $p = [];
        collect($permissions)->each(function ($module) use (&$p){
            foreach ($module as $permission){
                $p[$permission] = true;
            }
        });
        return $p;
    }
}