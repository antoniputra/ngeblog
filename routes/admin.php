<?php

use AntoniPutra\Ngeblog\Http\Controllers\NgeblogController;
use Illuminate\Support\Facades\Route;

Route::controller(NgeblogController::class)
    ->name('ngeblog.')
    ->group(function () {
        Route::get('/', 'blogs')->name('blogs');
    });