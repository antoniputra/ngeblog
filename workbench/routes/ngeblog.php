<?php

use Illuminate\Support\Facades\Route;
use Workbench\App\Http\Controllers\NgeblogPostController;

Route::controller(NgeblogPostController::class)
    ->prefix('blogs')
    ->name('blogs.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{ngeblogPost}', 'show')->name('show');
    });
