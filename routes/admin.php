<?php

Route::get('/', function () {
    return view('admin.index');

})->name('index');


/**Ngôn ngữ */
Route::prefix('languages')->name('languages.')->middleware('checkSuperAdmin')->group(function () {
    $controller = 'Admin\LanguageController@';
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

/** Danh mục */
Route::prefix('category')->name('category.')->group(function () {
    $controller = 'Admin\CategoryController@';
    Route::get('/', $controller . 'index')->name('list');
    Route::get('/post', $controller . 'addView')->name('postView');
    Route::post('/post', $controller . 'postCategory')->name('postAction');
    Route::get('/edit/{id}', $controller . 'editView')->name('editView');
    Route::post('/edit/{id}', $controller . 'postEdit')->name('editAction');
    Route::get('/translate-category/{categoryId}', $controller . 'addView')->name('categoryTranslateView');
    Route::post('/translate-category/{categoryId}', $controller . 'categoryTranslate')->name('categoryTranslate');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
});


/** Bài viết */
Route::prefix('posts')->name('post.')->group(function () {
    $controller = 'Admin\PostController@';
    Route::get('/', $controller . 'index')->name('list');
    Route::get('/create', $controller . 'addView')->name('addView');
    Route::post('/create', $controller . 'store')->name('addAction');
    Route::get('/show-post/{id}', $controller . 'show')->name('show');
    Route::get('/edit/{id}', $controller . 'editView')->name('editView');
    Route::post('/edit/{id}', $controller . 'postEdit')->name('editAction');
    Route::get('/translate-post/{postId}', $controller . 'addView')->name('translateView');
    Route::post('/translate-post/{postId}', $controller . 'translate')->name('translateAction');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
});

/** Phòng */
Route::prefix('{location_id}/rooms')->name('rooms.')->group(function () {
    $controller = 'Admin\RoomController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/create', $controller . 'create')->name('create');
    Route::post('/store', $controller . 'store')->name('store');
    Route::post('delete-room-number/{id}', $controller . 'deleteRoomNumber')->name('deleteRoomNumber');
    Route::get('/show-original/{id}', $controller . 'showOriginal')->name('showOriginal');
    Route::get('/edit/{id}', $controller . 'edit')->name('edit');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
    Route::get('/translation/{id}', $controller . 'translation')->name('translation');
    Route::post('/store-translation/{id}', $controller . 'storeTranslation')->name('storeTranslation');
    Route::post('/add-properties', $controller . 'addProperties')->name('addProperties');
    Route::post('/delete-properties', $controller . 'deleteProperties')->name('deleteProperties');
});

/** Tiện nghi */
Route::prefix('properties')->name('properties.')->group(function () {
    $controller = 'Admin\PropertyController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::post('/store', $controller . 'store')->name('store');
    Route::get('/edit/{id}', $controller . 'edit')->name('edit');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
    Route::get('/translation/{id}', $controller . 'translation')->name('translation');
    Route::post('/store-translation/{id}', $controller . 'storeTranslation')->name('storeTranslation');
});

/** Người dùng */
Route::prefix('users')->name('users.')->group(function () {
    $controller = 'Admin\UserController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/create', $controller . 'create')->name('create');
    Route::post('/store', $controller . 'store')->name('store');
    Route::get('/edit/{id}', $controller . 'edit')->name('edit');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
    Route::get('/deactive/{id}', $controller . 'deactive')->name('deactive');
    Route::get('/active/{id}', $controller . 'active')->name('active');

});


/** Hóa đơn */
Route::prefix('invoices')->name('invoices.')->group(function () {
    $controller = 'Admin\InvoiceController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/create', $controller . 'create')->name('create');
    Route::post('/store', $controller . 'store')->name('store');
    Route::get('/get-available-room', $controller . 'getAvailableRoom')->name('getAvailableRoom');
    Route::get('/get-available-room-number/{id}', $controller . 'getAvailableRoomNumbers')->name('getAvailableRoomNumbers');
});