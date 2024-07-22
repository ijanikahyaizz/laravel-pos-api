<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// register
Route::post('/user/register',[App\Http\Controllers\Api\Authcontroller::class,'register']);
Route::post('/user/login',[App\Http\Controllers\Api\Authcontroller::class,'login']);
Route::post('/user/logout',[App\Http\Controllers\Api\Authcontroller::class,'logout'])->middleware('auth:sanctum');
