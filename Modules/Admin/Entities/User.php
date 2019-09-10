<?php

namespace Modules\Admin\Entities;

use Cartalyst\Sentinel\Users\EloquentUser;
use Collective\Html\HtmlFacade;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Laracasts\Presenter\PresentableTrait;
use Modules\Admin\Entities\Presenters\UserPresenter;
use PendoNL\LaravelFontAwesome\LaravelFontAwesome;
use Sentinel;

class User extends EloquentUser implements Authenticatable
{
    use AuthenticableTrait;
    use Notifiable;
    use PresentableTrait;

    protected $table = 'users';

    protected $presenter = UserPresenter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $appends = ['actions'];

    /**
     * ------------------------------------------------------------------------
     * MODEL VALIDATION RULES
     * ------------------------------------------------------------------------
     */

    public static function getValidationRules(){
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ];
    }


    /**
     * ------------------------------------------------------------------------
     * ACCESSORS
     * ------------------------------------------------------------------------
     */
    public function getActionsAttribute(){
        $actions_html = '';

        if (Sentinel::hasAccess('read-users')) {
            $actions_html .= HtmlFacade::link(
                route('admin.users.show', ['user' => $this->id]),
                app('laravel-font-awesome')->icon('fa-search'),
                ['title' => 'User Detail'],
                false,
                false
            );
        }

        if (Sentinel::hasAccess('edit-users')) {
            $actions_html .= modal_anchor(
                route('admin.users.edit', ['user' => $this->id]),
                app('laravel-font-awesome')->icon('fa-pencil'),
                ['class' => 'edit' , 'title' => 'Edit User']
            );
        }


        $dtDropdownListItems = [];

        if (Sentinel::hasAccess('delete-users')) {
            $dtDropdownListItems[] = HtmlFacade::link(
                '#',
                'Delete',
                [
                    'data-id'=> $this->id,
                    'data-action' => 'delete-confirmation',
                    'data-action-url' => route('admin.users.destroy'),
                ],
                false,
                false
            );
        }

        $actions_html .= '<div class="dropdown">
								<a class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="caret"></span>
                                </a>
							 ';



        $actions_html .= HtmlFacade::ul( $dtDropdownListItems, [
            'class' => 'dropdown-menu',
            'aria-labelledby' => 'dropdownMenu1'
        ]);

        $actions_html .=  '</div>';

        return $actions_html;
    }

    function getFullNameAttribute(){
        return $this->first_name .' '. $this->last_name;
    }

}
