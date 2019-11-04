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
Route::get('/','Client\HomeController@index')->name('home');
// Auth::routes(['verify' => true]);

Route::get('/test-client', function () {
    return view('client.rooms.index');
});

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@submitLogin')->name('submitLogin');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/register', 'Auth\RegisterController@submitRegister')->name('submitRegister');
Route::get('/verify/token/{token_cookie}', 'Auth\RegisterController@submitVerify')->name('verifyRegister');
Route::get('/verify/form', 'Auth\RegisterController@verifyForm')->name('verifyForm');

Route::get('/change-language/{id}', 'LanguageController@change')->name('changeLanguage');

/** Danh sách phòng */
Route::prefix('/rooms')->name('rooms.')->group(function () {
    $controller = 'Client\RoomController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/{id}', $controller . 'detail')->name('detail');
});
