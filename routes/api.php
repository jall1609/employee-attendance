<?php

use App\Http\Controllers\APIController\APIAbsensiController;
use App\Http\Controllers\APIController\APIAuthController;
use App\Http\Controllers\APIController\APIEmployeeController;
use App\Http\Middleware\APIActiveEmployeeMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\APIAdminMiddleware;
use App\Http\Middleware\APIEmployeeMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\JWTMiddleware;

Route::group(['prefix' => 'employee', 'middleware' => [JWTMiddleware::class, APIEmployeeMiddleware::class, APIActiveEmployeeMiddleware::class ]], function(){
    Route::post('/absensi', [APIAbsensiController::class, 'absensi']);
    Route::get('/get-absensi', [APIAbsensiController::class, 'getAbsensi']);
});
Route::group(['prefix' => 'auth'], function(){
    Route::post('/register-admin', [APIAuthController::class, 'registerCompany'])->middleware('guest');
    Route::post('/login', [APIAuthController::class, 'login'])->middleware('guest');
    Route::post('/logout', [APIAuthController::class, 'logout'])->middleware(JWTMiddleware::class);
});
Route::group(['prefix' => 'admin', 'middleware' => [JWTMiddleware::class, APIAdminMiddleware::class] ], function(){
    Route::apiResource('/employee', APIEmployeeController::class);
});