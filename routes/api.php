<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\JWTMiddleware;

Route::group(['prefix' => 'employee', 'middleware' => [JWTMiddleware::class, EmployeeMiddleware::class ]], function(){

});
Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function(){
    Route::post('/register-admin', [AuthController::class, 'registerCompany'])->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
});
