<?php

use Illuminate\Support\Facades\Route;

Route::domain('https://yada.test')->group(function() {
    Route::get('/', function () {
        return redirect()->route('web.home');
    });
});
Route::domain('https://yada.test')->group(function() {
    Route::get('/', function () {
        return redirect()->route('app.dashboard');
    });
});
Route::domain('https://yada.test')->group(function() {
    Route::get('/', function () {
        return redirect()->route('auth.sign-in');
    });
});

require __DIR__.'/settings.php';
