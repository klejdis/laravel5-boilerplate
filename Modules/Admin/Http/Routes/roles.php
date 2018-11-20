<?php

/**
 * Roles Routes
 */

Route::get('/roles', [
    'as'     => 'roles.index',
    'uses'   => 'RolesController@index',
    'middleware' => 'permission:browse-roles'
]);

Route::post('/roles/datatable', [
    'as'     => 'roles.datatable',
    'uses'   => 'RolesController@datatable',
    'middleware' => 'permission:browse-roles'
]);

Route::get('/roles/{roles}/show', [
    'as'     => 'roles.show',
    'uses'   => 'RolesController@show',
    'module' => 'Roles',
    'middleware' => 'permission:read-roles'
]);

Route::post('/roles/create', [
    'as'     => 'roles.create',
    'uses'   => 'RolesController@create',
    'middleware' => 'permission:create-roles'
]);

Route::post('/roles/quick-create', [
    'as'     => 'roles.quick_create',
    'uses'   => 'RolesController@quickCreate',
    'middleware' => 'permission:create-roles'
]);

Route::post('/roles', [
    'as'     => 'roles.store',
    'uses'   => 'RolesController@store',
    'middleware' => 'permission:create-roles'
]);

Route::get('/roles/{role}/edit', [
    'as'     => 'roles.edit',
    'uses'   => 'RolesController@edit',
    'middleware' => 'permission:edit-roles'
]);

Route::put('/roles/{role}', [
    'as'     => 'roles.update',
    'uses'   => 'RolesController@update',
    'middleware' => 'permission:edit-roles'
]);

Route::delete('/roles/{role}', [
    'as'     => 'roles.destroy',
    'uses'   => 'RolesController@delete',
    'middleware' => 'permission:delete-roles'
]);