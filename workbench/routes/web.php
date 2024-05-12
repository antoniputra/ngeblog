<?php

use Illuminate\Support\Facades\Route;
use Workbench\App\Models\User;

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/login', function () {
    auth()->login(User::first());
    return redirect()->to(config('ngeblog.path'));
})->name('login');

Route::get('/logout', function () {
    auth()->logout();
    return to_route('landing');
});

require __DIR__ . '/ngeblog.php';
