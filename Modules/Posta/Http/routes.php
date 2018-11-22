<?php

Route::group(['middleware' => 'web', 'prefix' => 'posta', 'namespace' => 'Modules\Posta\Http\Controllers'], function()
{
    Route::get('/', 'PostaController@index');
});
