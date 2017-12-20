<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => config('ngeblog.admin_prefix')], function () {
    Route::get('/', 'BlogController@dashboard')->name('ngeblog.dashboard');

    Route::resource('/category', 'CategoryController', ['names' => [
        'index' => 'ngeblog.category.index',
        'create' => 'ngeblog.category.create',
        'store' => 'ngeblog.category.store',
        'edit' => 'ngeblog.category.edit',
        'update' => 'ngeblog.category.update',
        'destroy' => 'ngeblog.category.destroy',
    ]]);

    Route::resource('/blog', 'BlogController', ['names' => [
        'index' => 'ngeblog.blog.index',
        'create' => 'ngeblog.blog.create',
        'store' => 'ngeblog.blog.store',
        'edit' => 'ngeblog.blog.edit',
        'update' => 'ngeblog.blog.update',
        'destroy' => 'ngeblog.blog.destroy',
    ]]);

    Route::get('metas/json', 'MetaController@getJson')->name('ngeblog.meta.getJson');
    Route::resource('metas', 'MetaController', ['names' => [
        'index' => 'ngeblog.meta.index',
        'create' => 'ngeblog.meta.create',
        'store' => 'ngeblog.meta.store',
        'edit' => 'ngeblog.meta.edit',
        'update' => 'ngeblog.meta.update',
        'destroy' => 'ngeblog.meta.destroy',
    ]]);
});

Route::group(['prefix' => config('ngeblog.public_prefix')], function () {
    Route::get('/', 'FrontController@blogIndex')->name('nb.index');
    Route::get('/{blog}', 'FrontController@blogShow')->name('nb.blog.show');
});
