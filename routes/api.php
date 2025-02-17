<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class,'index']);
Route::get('/posts/{id}', [PostController::class,'show']);

Route::post('/posts/store', [PostController::class,'store']);
Route::get('/posts/create', [PostController::class,'create']);

Route::delete('/posts/{id}/delete', [PostController::class,'destroy']);
Route::put('/posts/{id}/update', [PostController::class,'update']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,'logout']);
