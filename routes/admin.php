<?php

Route::get('/', function () {
    return view('admin.index');
})->name('index');

/**Ngôn ngữ */
Route::prefix('languages')->name('languages.')->middleware('checkSuperAdmin')->group(function () {
    $controller  = 'Admin\LanguageController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/create', $controller . 'create')->name('create');
    Route::post('/store', $controller . 'store')->name('store');
});
