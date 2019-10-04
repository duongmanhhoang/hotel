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
    Route::get('/edit/{id}', $controller . 'edit')->name('edit');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::get('/deactive/{id}', $controller . 'deactive')->name('deactive');
    Route::get('/active/{id}', $controller . 'active')->name('active');
});
