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
    return view('client.rooms.room-detail');
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

/** Danh sách bài viết */
Route::prefix('/posts')->name('post.')->group(function () {
    $controller = 'Client\PostController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/category/{name}', $controller . 'getPostViaCategoryName')->name('categoryPost');
    Route::get('/{id}', $controller . 'detail')->name('detail');
});

/** Liên hệ */
Route::prefix('/contact')->name('contact.')->group(function () {
    $controller = 'Client\ContactController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::post('/post-contact', $controller . 'postContact')->name('postContact');
});

/** Booking */
Route::prefix('booking')->name('booking.')->group(function () {
    $controller = 'Client\BookingController@';
    Route::get('', $controller . 'index')->name('index');
    Route::post('redirectBooking', $controller . 'redirectBooking')->name('redirectBooking');
    Route::post('submit', $controller . 'submit')->name('submit');
});

/** User */
Route::prefix('user')->name('user.')->group(function () {
    $controller = 'Client\UserController@';
    Route::post('/register', $controller . 'register')->name('register');
    Route::get('/active', $controller . 'activeUser')->name('active');
});

/** Profile */
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    $controller = 'Client\ProfileController@';
    Route::get('mybooking', $controller . 'mybooking')->name('mybooking');
    Route::post('mask-as-read/{id}', $controller . 'maskAsRead')->name('maskAsRead');
    Route::post('mask-all-as-read', $controller . 'maskAllRead')->name('maskAllRead');
    Route::post('cancel-booking/{id}', $controller . 'cancelBooking')->name('cancelBooking');
});

/** Chat */
Route::prefix('chat-with-admin')->name('chatWithAdmin.')->group(function () {
    $chatController = 'Client\ChatController@';
    Route::post('submit-email', $chatController . 'submitEmail')->name('submitEmail');
    Route::post('send', $chatController . 'send')->name('send');
});

Route::prefix('forget-password')->name('forgetPassword.')->group(function () {
    $controller = 'Auth\ForgotPasswordController@';
    Route::get('', $controller . 'index')->name('index');
    Route::post('sendMail', $controller . 'sendMail')->name('sendMail');
    Route::get('reset', $controller . 'reset')->name('reset');
    Route::post('resetPassword', $controller . 'resetPassword')->name('resetPassword');
});
