<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
|
|
*/

Route::group(['middleware' => 'guest:api', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');

    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'VerificationController@resend');

    Route::post('oauth/{driver}', 'OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'OAuthController@handleProviderCallback')->name('oauth.callback');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::group(['namespace' => 'Account'], function () {
        Route::resource('accounts', 'AccountController');
    });

    Route::group(['namespace' => 'Asset'], function () {
        Route::resource('assets', 'AssetController');
    });

    Route::group(['namespace' => 'Organization'], function () {
        // Route::get('organizations', 'OrganizationController@index')->name('organizations.index');
        Route::resource('organizations', 'OrganizationController');
        Route::get('organizations/{organization}/toml', 'TomlController@show');
    });

});

Route::fallback(function () {
    abort(404);
});
