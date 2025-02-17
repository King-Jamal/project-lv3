<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts/create', function () {
    return view('create',['title'=>'Create Post']);
});

Route::get('/home', function () {
    return view('home',['title'=>'Home Page']);
});
Route::get('/posts', [PostController::class,'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class,'show'])->name('posts.show');
// Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class,'store'])->name('posts.store');
// Route::get('/posts/{id}/delete', [PostController::class,'destroy']);
Route::delete('/posts/{id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/{id}/update', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
