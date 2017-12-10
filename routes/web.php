<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => config('ngeblog.admin_prefix')], function () {
    Route::get('/', 'BlogController@dashboard')->name('ngeblog.dashboard');

    Route::resource('/category', 'CategoryController', ['names' => [
        'index'   => 'ngeblog.category.index',
        'create'  => 'ngeblog.category.create',
        'store'   => 'ngeblog.category.store',
        'edit'    => 'ngeblog.category.edit',
        'update'  => 'ngeblog.category.update',
        'destroy' => 'ngeblog.category.destroy',
    ]]);

    Route::resource('/blog', 'BlogController', ['names' => [
        'index'   => 'ngeblog.blog.index',
        'create'  => 'ngeblog.blog.create',
        'store'   => 'ngeblog.blog.store',
        'edit'    => 'ngeblog.blog.edit',
        'update'  => 'ngeblog.blog.update',
        'destroy' => 'ngeblog.blog.destroy',
    ]]);

    Route::get('/post-meta/field', 'PostMetaController@getPostMetaField')->name('ngeblog.postmeta.field');
    Route::resource('/post-meta', 'PostMetaController', ['names' => [
        'index'   => 'ngeblog.postmeta.index',
        'create'  => 'ngeblog.postmeta.create',
        'store'   => 'ngeblog.postmeta.store',
        'edit'    => 'ngeblog.postmeta.edit',
        'update'  => 'ngeblog.postmeta.update',
        'destroy' => 'ngeblog.postmeta.destroy',
    ]]);
});

Route::group(['prefix' => config('ngeblog.public_prefix')], function () {
    Route::get('/', 'FrontController@blogIndex')->name('nb.index');
    Route::get('/{blog}', 'FrontController@blogShow')->name('nb.blog.show');
});
