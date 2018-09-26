<?php

/**
 * ----------------------------------------------------------------------------
 * This file loads all Admin Module Routes whic are prefixed with /admin and
 * route names are prefixed with admin.
 * ----------------------------------------------------------------------------
 */
Route::group([
    'middleware' => 'web',
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Modules\Admin\Http\Controllers',
], function()
{
    include_route_files(__DIR__.'/Routes/');
});


