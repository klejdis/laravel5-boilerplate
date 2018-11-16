<?php

namespace Modules\Admin\Entities\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function firstRoleLabeled(){
        $role = $this->entity->roles()->first();
        return ($role !== null) ? '<label class="label label-info large"><strong> '.$role->name.' </strong></label>' : '';
    }

    public function profileImage(){
        $default = asset('admin/images/avatar.jpg');
        return '<img id="profile-image-preview" src="'.$default.'" alt="">';
    }

}