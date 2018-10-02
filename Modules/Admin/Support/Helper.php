<?php

namespace Modules\Admin\Support;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;
use Sentinel;

class Helper{


    /**
     * Get Previous Route
     *
     * @return Route
     */
    public static function getPreviusRoute(){
        return app('router')->getRoutes()->match(app('request')->create(URL::previous()));
    }

    /**
     * Get Previous Request
     *
     * @return Route
     */
    public static function getPreviusRequest(){
        return app('request')->create(URL::previous());
    }


    /**
     * Check If User Has Access On Previus Route
     *
     * @param Route $route
     * @return bool
     */
    public static  function checkRouteForPermission(Route $route){
        $permissions = $route->getAction('middleware');

        $permissions = collect($permissions);

        $permission = $permissions->search(function ($item,$key){
            return str_contains($item,'permission:');
        });

        if ($permission){
            $p = explode(':',$permissions[$permission]);

            if ($p[0] == 'permission' && isset($p[1]) && $p[1] !== null){
                return Sentinel::hasAccess($p[1]);
            }

        }

        return false;
    }





}