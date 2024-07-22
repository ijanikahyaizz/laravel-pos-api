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


// product create
Route::post('/product/create',[App\Http\Controllers\Api\ProductController::class,'create'])->middleware('auth:sanctum');
// product list by user
Route::get('/product',[App\Http\Controllers\Api\ProductController::class,'index'])->middleware('auth:sanctum');
// product detail by id creted by user
Route::get('/product/{id}',[App\Http\Controllers\Api\ProductController::class,'show'])->middleware('auth:sanctum');
// product update by id created by user
Route::put('/product/{id}',[App\Http\Controllers\Api\ProductController::class,'update'])->middleware('auth:sanctum');
// product delete by id created by user
Route::delete('/product/{id}',[App\Http\Controllers\Api\ProductController::class,'delete'])->middleware('auth:sanctum');
// get all product
Route::get('/products',[App\Http\Controllers\Api\ProductController::class,'all'])->middleware('auth:sanctum');
