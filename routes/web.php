<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', [AdminController::class, 'login'])->middleware('guest')->name('login');
    Route::post('/login', [AdminController::class, 'prosesLogin'])->middleware('guest');
    Route::group(['middleware' => [JWTMiddleware::class] ], function(){
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });
});