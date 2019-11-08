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

Route::get('/', 'Client\HomeController@index')->name('home');

Route::get('/test-client', function () {
    return view('client.contact.index');
});

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@submitLogin')->name('submitLogin');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/change-language/{id}', 'LanguageController@change')->name('changeLanguage');

/** Danh sách phòng */
Route::get('/search', 'Client\RoomController@search')->name('rooms.search');
Route::prefix('/rooms/{location_id}')->name('rooms.')->group(function () {
    $controller = 'Client\RoomController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/{id}', $controller . 'detail')->name('detail');
    Route::post('/{id}/comment', $controller . 'comment')->name('comment');
});

/** Danh sách phòng */
Route::prefix('/posts')->name('post.')->group(function () {
    $controller = 'Client\PostController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/category/{name}', $controller . 'getPostViaCategoryName')->name('categoryPost');
    Route::get('/{id}', $controller . 'detail')->name('detail');
});

/** Booking */
Route::prefix('booking')->name('booking.')->group(function () {
    $controller = 'Client\BookingController@';
    Route::get('', $controller . 'index')->name('index');
    Route::post('redirectBooking', $controller . 'redirectBooking')->name('redirectBooking');
    Route::post('submit', $controller . 'submit')->name('submit');
});


