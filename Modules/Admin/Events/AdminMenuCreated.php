<?php

namespace Modules\Admin\Events;

use Illuminate\Queue\SerializesModels;

class AdminMenuCreated
{
    use SerializesModels;

    public $menu;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($menu)
    {
        $this->menu = $menu;
    }

}
