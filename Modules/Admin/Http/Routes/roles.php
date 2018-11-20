<?php

Route::get('/roles', [
    'as'     => 'roles.index',
    'uses'   => 'RolesController@index',
    'middleware' => 'permission:browse-roles'
]);
