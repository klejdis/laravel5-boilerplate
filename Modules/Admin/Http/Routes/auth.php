<?php

/**
 * BACKEND AUTH ROUTES
 */

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login' , [
        'as' 	 => 'auth.login',
        'permission' => true,
        'uses'   => 'LoginController@login',
    ]);

    Route::post('/logout' , [
        'as' 	 => 'auth.logout',
        'uses'   => 'LoginController@logout',
        'permission' => true,
    ]);

    Route::post('/login' , [
        'as' 	 => 'auth.login.post',
        'permission' => true,
        'uses'   => 'LoginController@authenticate',
    ]);

    Route::get('/register' , [
        'as' 	 => 'auth.register.index',
        'permission' => true,
        'uses'   => 'RegisterController@register',
    ]);

    Route::post('/register' , [
        'as' 	 => 'auth.register.store',
        'permission' => true,
        'uses'   => 'RegisterController@postRegister',
    ]);

    Route::get('/activate/user/{user}/code/{code}' , [
        'as' 	 => 'auth.activate.account',
        'permission' => true,
        'uses'   => 'RegisterController@activate',
    ]);

    Route::get('/password/reset' , [
        'as' 	 => 'auth.forgot_password',
        'permission' => true,
        'uses'   => 'ForgotPasswordController@forgotPassword',
    ]);

    Route::post('/password/email' , [
        'as' 	 => 'auth.forgot_password.store',
        'permission' => true,
        'uses'   => 'ForgotPasswordController@postForgotPassword',
    ]);

    Route::get('/password/reset/user/{user}/code/{code}' , [
        'as' 	 => 'auth.forgot_password.form',
        'permission' => true,
        'uses'   => 'ForgotPasswordController@changePassword',
    ]);

    Route::post('/password/reset/' , [
        'as' 	 => 'auth.forgot_password.update',
        'permission' => true,
        'uses'   => 'ForgotPasswordController@postChangePassword',
    ]);

});












