<?php

Route::get('/', 'AdminController@index');

Route::get('/dashboard', [
    'as'     => 'dashboard.index',
    'uses'   => 'DashboardContoller@index',
    //'middleware' => 'permission:browse-dashboard'
]);