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