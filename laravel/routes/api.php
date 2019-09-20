<?php

use Illuminate\Http\Request;
use Laravel\Vapor\Http\Controllers\SignedStorageUrlController;

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

    Route::post('image', 'ImageController@store')->name('image.create');
    Route::delete('image', 'ImageController@destroy')->name('image.destroy');

    Route::group(['namespace' => 'Account'], function () {
        Route::resource('accounts', 'AccountController');
    });

    Route::group(['namespace' => 'Asset'], function () {
        Route::resource('assets', 'AssetController');
    });

    Route::group(['namespace' => 'Organization'], function () {
        Route::resource('organizations', 'OrganizationController');
        Route::get('organizations/{organization}/toml', 'TomlController@show')->name('organizations.toml');
        Route::post('organizations/{organization}/link', 'LinkResourceController@store')->name('organizations.link');
        Route::delete('organizations/{organization}/link', 'LinkResourceController@destroy')->name('organizations.unlink');
        Route::post('organizations/{organization}/publish', 'PublishController@store')->name('organizations.publish');
        Route::delete('organizations/{organization}/publish', 'PublishController@destroy')->name('organizations.unpublish');
    });

    Route::group(['namespace' => 'Principal'], function () {
        Route::resource('principals', 'PrincipalController');
    });

    Route::group(['namespace' => 'Validator'], function () {
        Route::resource('validators', 'ValidatorController');
    });

});

Route::fallback(function () {
    abort(404);
});
