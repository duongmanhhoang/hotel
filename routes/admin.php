<?php

Route::get('/', function () {
    return view('admin.index');

})->name('index');

Route::group(['prefix' => 'category'], function() {
    Route::get('/', 'Admin\CategoryController@getCategory')->name('category.list');
    Route::get('/post', 'Admin\CategoryController@addView')->name('category.postView');
    Route::post('/post', 'Admin\CategoryController@postCategory')->name('category.postAction');
    Route::get('/edit/{id}', 'Admin\CategoryController@editView')->name('category.editView');
    Route::post('/edit/{id}', 'Admin\CategoryController@postEdit')->name('category.editAction');
    Route::delete('/delete/{id}', 'Admin\CategoryController@deleteCategory')->name('category.delete');
});

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

/** Cơ sở */
Route::prefix('locations')->name('locations.')->group(function () {
    $controller = 'Admin\LocationController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/create', $controller . 'create')->name('create');
    Route::post('/store', $controller . 'store')->name('store');
    Route::get('/show-original/{id}', $controller . 'showOriginal')->name('showOriginal');
    Route::get('/edit/{id}', $controller . 'edit')->name('edit');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
    Route::get('/translation/{id}', $controller . 'translation')->name('translation');
    Route::post('/store-translation/{id}', $controller . 'storeTranslation')->name('storeTranslation');
});
