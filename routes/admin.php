<?php

Route::get('/', 'Admin\DashboardController@index')->name('index');


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
    Route::get('/{status?}', $controller . 'index')->name('list');
    Route::get('/create/new', $controller . 'addView')->name('addView');
    Route::post('/create/new', $controller . 'store')->name('addAction');
    Route::get('/show-post/{id}', $controller . 'show')->name('show');
    Route::get('/edit/{id}', $controller . 'editView')->name('editView');
    Route::post('/edit/{id}', $controller . 'postEdit')->name('editAction');
    Route::get('/translate/{postId}', $controller . 'addView')->name('translateView');
    Route::post('/translate/{postId}', $controller . 'translate')->name('translateAction');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
    Route::get('/get/approve-posts/{status?}', $controller . 'getApproveList')->name('approveList');
    Route::get('/approving-post/{id}/{approve}', $controller . 'approvingPost')->name('approvingPost');
});

/** Phòng */
Route::post('/rooms/upload-images/{id}', 'Admin\RoomController@uploadImage')->name('rooms.uploadImage');
Route::post('/rooms/destroy-images', 'Admin\RoomController@destroyImage')->name('rooms.destroyImage');
Route::post('/rooms/delete-room-number', 'Admin\RoomController@deleteRoomNumber')->name('rooms.deleteRoomNumber');
Route::get('/rooms/delete-images/{id}', 'Admin\RoomController@deleteImage')->name('rooms.deleteImage');
Route::prefix('{location_id}/rooms')->name('rooms.')->group(function () {
    $controller = 'Admin\RoomController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/create', $controller . 'create')->name('create');
    Route::post('/store', $controller . 'store')->name('store');
    Route::get('/show-original/{id}', $controller . 'showOriginal')->name('showOriginal');
    Route::get('/edit/{id}', $controller . 'edit')->name('edit');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
    Route::get('/translation/{id}', $controller . 'translation')->name('translation');
    Route::post('/store-translation/{id}', $controller . 'storeTranslation')->name('storeTranslation');
    Route::post('/add-properties', $controller . 'addProperties')->name('addProperties');
    Route::post('/delete-properties', $controller . 'deleteProperties')->name('deleteProperties');
    Route::post('delete-room-number/{id}', $controller . 'deleteRoomNumber')->name('deleteRoomNumber');
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
Route::prefix('users')->name('users.')->middleware('checkSuperAdmin&Admin')->group(function () {
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

    Route::get('/edit/{id}', $controller . 'edit')->name('edit');
    Route::get('/show/{id}', $controller . 'show')->name('show');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::post('/mark-as-return/{id}', $controller . 'markAsReturn')->name('markAsReturn');
});

/** Caft đặt website */
Route::prefix('settings')->name('settings.')->group(function () {
    $controller = 'Admin\WebSettingController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/edit', $controller . 'edit')->name('edit');
    Route::post('/update/{id}', $controller . 'update')->name('update');
});

/** Quản lý roles */
Route::prefix('roles')->name('roles.')->middleware('checkSuperAdmin')->group(function () {
    $controller = 'Admin\RoleController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::get('/create', $controller . 'create')->name('create');
    Route::post('/store', $controller . 'store')->name('store');
    Route::get('/edit/{id}', $controller . 'edit')->name('edit');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
});

/** Quản lý routes */
Route::prefix('routes')->name('routes.')->middleware('checkSuperAdmin')->group(function () {
    $controller = 'Admin\RouteController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::post('/store', $controller . 'store')->name('store');
    Route::post('/delete', $controller . 'delete')->name('delete');
});

/** Hóa đơn */
Route::prefix('bills')->name('bill.')->group(function () {
    $controller = 'Admin\BillController@';
    Route::get('/', $controller . 'index')->name('list');
    Route::get('/post', $controller . 'addView')->name('postView');
    Route::post('/post', $controller . 'store')->name('postAction');
    Route::get('/edit/{id}', $controller . 'editView')->name('editView');
    Route::post('/edit/{id}', $controller . 'postEdit')->name('editAction');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
});

/** Tên phòng */
Route::prefix('room-name')->name('roomNames.')->group(function () {
    $controller = 'Admin\RoomNameController@';
    Route::get('/', $controller . 'index')->name('index');
    Route::post('/store', $controller . 'store')->name('store');
    Route::post('/update/{id}', $controller . 'update')->name('update');
    Route::post('/delete/{id}', $controller . 'delete')->name('delete');
    Route::get('/translation/{id}', $controller . 'translation')->name('translation');
    Route::post('/store-translation/{id}', $controller . 'storeTranslation')->name('storeTranslation');
});


/** Thống kê */
Route::prefix('statistical')->name('statistical.')->group(function () {
    $controller = 'Admin\StatisticalController@';
    Route::post('/', $controller . 'index')->name('list');
});

/** Thống kê dashboard */
Route::prefix('analytics')->name('analytics.')->group(function () {
    $controller = 'Admin\DashboardController@';
    Route::post('/user-analytics', $controller . 'userAnalytic')->name('users');
    Route::post('/user-access', $controller . 'userAccess')->name('userAccess');
});

