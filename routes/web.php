<?php

use App\Http\Controllers\WebController\AbsensiController;
use App\Http\Controllers\WebController\AdminController;
use App\Http\Controllers\WebController\AuthController;
use App\Http\Controllers\WebController\EmployeeController;
use App\Http\Middleware\ActiveEmployeeMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', [AdminController::class, 'login'])->middleware('guest')->name('login');
    Route::group(['middleware' => [  AuthMiddleware::class, AdminMiddleware::class] ], function(){
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('/employee', EmployeeController::class);
    });
});
Route::group(['prefix' => 'auth'], function(){
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/', [AbsensiController::class, 'index'])->middleware('guest');
Route::group(['prefix' => 'employee', 'middleware' => [AuthMiddleware::class, EmployeeMiddleware::class, ActiveEmployeeMiddleware::class] ], function(){
    Route::get('/absensi', [AbsensiController::class, 'absensiForm'])->name('employee.absensi');
    Route::post('/absensi', [AbsensiController::class, 'absensi']);
});