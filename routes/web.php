<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => config('ngeblog.admin_prefix')], function () {
    Route::get('/', function () {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('ngeblog::admin.dashboard', $data);
    })->name('ngeblog.dashboard');

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
});

Route::group(['prefix' => config('ngeblog.public_prefix')], function () {
    Route::get('/category', 'NgeblogController@categoryIndex')->name('category.index');
    Route::get('/category/{category}', 'NgeblogController@categoryShow')->name('category.show');

    Route::get('/', 'NgeblogController@blogIndex')->name('blog.index');
    Route::get('/{blog}', 'NgeblogController@blogShow')->name('blog.show');
});
