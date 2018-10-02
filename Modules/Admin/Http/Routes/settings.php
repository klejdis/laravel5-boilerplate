<?php

/**
 * SETTINGS ROUTES
 */

Route::get('/settings/{tab?}' , [
    'as'     => 'setting.index',
    'uses'   => 'SettingsController@index',
    'middleware' => 'permission:browse-settings'
]);

Route::post('/settings' , [
    'as'     => 'setting.store',
    'uses'   => 'SettingsController@store',
    'middleware' => 'permission:edit-settings'
]);

