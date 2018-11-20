<?php

/**
 * User Routes
 */
Route::get('/users', [
    'as'     => 'users.index',
    'uses'   => 'UsersController@index',
    'middleware' => 'permission:browse-users'
]);

Route::post('/users/datatable', [
    'as'     => 'users.datatable',
    'uses'   => 'UsersController@datatable',
    'middleware' => 'permission:browse-users'
]);

Route::get('/users/{user}/show', [
    'as'     => 'users.show',
    'uses'   => 'UsersController@show',
    'middleware' => 'permission:read-users'
]);

Route::get('/users/{user}/show/general-info/tab', [
    'as'     => 'users.show.general_info_tab',
    'uses'   => 'UsersController@generalInfoTab',
    'middleware' => 'permission:read-users'
]);

Route::get('/users/{user}/show/change-password/tab', [
    'as'     => 'users.show.change_password',
    'uses'   => 'UsersController@changePasswordTab',
    'middleware' => 'permission:read-users'
]);

Route::post('/users/{user}/show/change-password', [
    'as'     => 'users.show.change_password.post',
    'uses'   => 'UsersController@changePassword',
    'middleware' => 'permission:read-users'
]);

Route::get('/users/{user}/show/permissions', [
    'as'     => 'users.show.permission',
    'uses'   => 'UsersController@permissionsTab',
    'middleware' => 'permission:read-users'
]);

Route::post('/users/{user}/show/permissions', [
    'as'     => 'users.show.permissions.post',
    'uses'   => 'UsersController@permissionsTabPost',
    'middleware' => 'permission:read-users'
]);

Route::post('/users/create', [
    'as'     => 'users.create',
    'uses'   => 'UsersController@create',
    'middleware' => 'permission:create-users'
]);

Route::post('/users', [
    'as'     => 'users.store',
    'uses'   => 'UsersController@store',
    'middleware' => 'permission:create-users'
]);

Route::post('/users/{user}/edit', [
    'as'     => 'users.edit',
    'uses'   => 'UsersController@edit',
    'middleware' => 'permission:edit-users'
]);

Route::post('/users/{user}/quick-update', [
    'as'     => 'users.quick_update',
    'uses'   => 'UsersController@quickUpdate',
    'middleware' => 'permission:edit-users'
]);

Route::post('/users/{user}', [
    'as'     => 'users.update',
    'uses'   => 'UsersController@update',
    'middleware' => 'permission:edit-users'
]);

Route::post('/users/delete', [
    'as'     => 'users.destroy',
    'uses'   => 'UsersController@delete',
    'middleware' => 'permission:delete-users'
]);
