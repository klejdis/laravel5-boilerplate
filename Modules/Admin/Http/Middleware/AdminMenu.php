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


                $user = Sentinel::check();
                $attr = ['icon' => 'fa fa-angle-double-right'];

                $menu->style('adminlte');

                // Dashboard
                $menu->route(
                    'admin.dashboard.index',
                    __('admin::admin.Dashboard'),
                    null,
                    ['target' => 'blank']
                );


                // Fire the event to extend the menu
                event(new AdminMenuCreated($menu));
        });

        return $next($request);
    }
}
