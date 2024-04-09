<?php

use AntoniPutra\Ngeblog\Http\Controllers\NgeblogController;
use Illuminate\Support\Facades\Route;

Route::get('resolve-css', function () {
    $content = file_get_contents(__DIR__ .'/../dist/ngeblog.css');
    return response($content)
        ->header('Content-Type', 'text/css');
})->name('resolve-css');

Route::get('resolve-js', function () {
    $content = file_get_contents(__DIR__ .'/../dist/ngeblog.js');
    return response($content)
        ->header('Content-Type', 'text/javascript');
})->name('resolve-js');

// Catch-all Route...
Route::get('/{view?}', NgeblogController::class)->where('view', '(.*)')->name('ngeblog.index');
