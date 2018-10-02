<?php

/**
 * BACKEND AUTH ROUTES
 */

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login' , [
        'as' 	 => 'auth.login',
        'authorized' => true,
        'uses'   => 'LoginController@login',
    ]);

    Route::post('/logout' , [
        'as' 	 => 'auth.logout',
        'uses'   => 'LoginController@logout',
        'authorized' => true,
    ]);

    Route::post('/login' , [
        'as' 	 => 'auth.login.post',
        'authorized' => true,
        'uses'   => 'LoginController@authenticate',
    ]);

    Route::get('/register' , [
        'as' 	 => 'auth.register.index',
        'authorized' => true,
        'uses'   => 'RegisterController@register',
    ]);

    Route::post('/register' , [
        'as' 	 => 'auth.register.store',
        'authorized' => true,
        'uses'   => 'RegisterController@postRegister',
    ]);

    Route::get('/activate/user/{user}/code/{code}' , [
        'as' 	 => 'auth.activate.account',
        'authorized' => true,
        'uses'   => 'RegisterController@activate',
    ]);

    Route::get('/password/reset' , [
        'as' 	 => 'auth.forgot_password',
        'authorized' => true,
        'uses'   => 'ForgotPasswordController@forgotPassword',
    ]);

    Route::post('/password/email' , [
        'as' 	 => 'auth.forgot_password.store',
        'authorized' => true,
        'uses'   => 'ForgotPasswordController@postForgotPassword',
    ]);

    Route::get('/password/reset/user/{user}/code/{code}' , [
        'as' 	 => 'auth.forgot_password.form',
        'authorized' => true,
        'uses'   => 'ForgotPasswordController@changePassword',
    ]);

    Route::post('/password/reset/' , [
        'as' 	 => 'auth.forgot_password.update',
        'authorized' => true,
        'uses'   => 'ForgotPasswordController@postChangePassword',
    ]);

});












