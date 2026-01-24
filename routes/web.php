<?php

use Illuminate\Support\Facades\Route;

Route::domain('yex.co.id')->group(function () {
    Route::get('/', function () {
        return redirect()->route('web.home');
    });
});
Route::domain('apps.yex.co.id')->group(function () {
    Route::get('/', function () {
        return redirect()->route('app.dashboard');
    });
});
Route::domain('sso.yex.co.id')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

require __DIR__.'/settings.php';
