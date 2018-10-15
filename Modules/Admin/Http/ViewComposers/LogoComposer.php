<?php

namespace Modules\Admin\Http\ViewComposers;

use Illuminate\View\View;
use Unisharp\Setting\SettingFacade as Setting;

class LogoComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('brand', asset('storage/'.Setting::get('app-logo')) );
    }
}