<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;

// Route::get('/posts', [PostController::class,'index'])
//     ->name('posts.index');

// Route::post('/posts', [PostController::class,'store'])
//     ->name('posts.store');

// Route::get('/posts/create', [PostController::class,'create'])
//     ->name('posts.create');

// Route::get('/posts/{id}', [PostController::class,'show'])
//     ->name('posts.show');

// Route::get('/posts/{id}/edit', [PostController::class,'edit'])
//     ->name('posts.edit');

// Route::put('/posts/{id}', [PostController::class,'update'])
//     ->name('posts.update');

// Route::delete('/posts/{id}', [PostController::class,'destroy'])
//     ->name('posts.destroy');

Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);
Route::post('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');

