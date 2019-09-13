<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function () {
    return (string) opcache_reset();
});

Route::get('/toml/{key}/.well-known/stellar.toml', 'TomlController@show');

Route::get('{path}', function () {
    return view('index');
})->where('path', '^(?!api).*$');
