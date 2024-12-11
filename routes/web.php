<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/', 'as' => 'login.'], function () {
    Route::get('', [LoginController::class, 'index'])->name('index');
    Route::post('', [LoginController::class, 'store'])->name('store');
});

Route::get('dashboard', function () {
    return 'dashboard';
});
