<?php

namespace Modules\Admin\Http\Middleware;

use Modules\Admin\Entities\Presenters\AdminMenuPresenter;
use Modules\Admin\Events\AdminMenuCreated;
use Nwidart\Menus\Facades\Menu;
use Sentinel;
use Closure;
use Illuminate\Http\Request;

class AdminMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
           // Setup the admin menu
           Menu::create('AdminMenu', function ($menu) {

               $menu->setPresenter(AdminMenuPresenter::class);
               $menu->style('adminlte');

                // Dashboard
                $menu->route(
                    'admin.dashboard.index',
                    __('admin::admin.Dashboard'),
                    null,
                    ['icon' => 'fa fa-desktop']
                )->order(0);

               $menu->dropdown('Users', function ($sub){
                   $sub->route(
                       'admin.users.index',
                       __('admin::admin.All Users'),
                       null,
                       ['icon' => 'dot fa fa-circle']
                   );

                   $sub->route(
                       'admin.roles.index',
                       __('admin::admin.Roles'),
                       null,
                       ['icon' => 'dot fa fa-circle']
                   );

                   $sub->route(
                       'admin.users.index',
                       __('admin::admin.Permissions'),
                       null,
                       ['icon' => 'dot fa fa-circle']
                   );

               }, ['icon' => 'fa fa-user'])->order(1);

               $menu->route(
                   'admin.setting.index',
                   __('admin::admin.Settings'),
                   null,
                   ['icon' => 'fa fa-wrench']
               )->order(2);



                // Fire the event to extend the menu
                event(new AdminMenuCreated($menu));
        });

        return $next($request);
    }
}
