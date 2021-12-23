<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Cms\Modules\Auth\Controllers',
    'middleware' => ['web'],
], function () {
    Route::group([
        'middleware' => ['cms.authenticated'],
    ], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');

        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    });
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
});
