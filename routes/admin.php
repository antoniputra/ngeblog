<?php

use AntoniPutra\Ngeblog\Http\Controllers\Api\PostController;
use AntoniPutra\Ngeblog\Http\Controllers\Api\TagController;
use AntoniPutra\Ngeblog\Http\Controllers\NgeblogController;
use AntoniPutra\Ngeblog\Http\Middleware\AjaxMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([AjaxMiddleware::class])
    ->prefix('api')
    ->name('api.')
    ->group(function () {

        Route::controller(PostController::class)
            ->prefix('posts')
            ->name('posts.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/{post}', 'show')->name('show');
                Route::put('/{post}/update', 'update')->name('update');
                Route::patch('/{post}/toggle-visibility', 'toggleVisibility')->name('toggleVisibility');
                Route::delete('/{post}/destroy', 'destroy')->name('destroy');
            });
        
        Route::controller(TagController::class)
            ->prefix('tags')
            ->name('tags.')
            ->group(function () {
                Route::get('/dropdown', 'dropdown')->name('dropdown');

                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/{tag}', 'show')->name('show');
                Route::put('/{tag}/update', 'update')->name('update');
                Route::patch('/{tag}/toggle-visibility', 'toggleVisibility')->name('toggleVisibility');
                Route::delete('/{tag}/destroy', 'destroy')->name('destroy');
            });

    });

// Catch-all Route...
Route::get('/{view?}', NgeblogController::class)->where('view', '(.*)')->name('ngeblog.index');
