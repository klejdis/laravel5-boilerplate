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


Route::put('/users/{user}', [
    'as'     => 'users.update',
    'uses'   => 'UsersController@update',
    'middleware' => 'permission:edit-users'
]);

Route::delete('/users/{user}', [
    'as'     => 'users.destroy',
    'uses'   => 'UsersController@delete',
    'middleware' => 'permission:delete-users'
]);
