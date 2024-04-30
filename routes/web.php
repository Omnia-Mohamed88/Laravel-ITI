<?php

// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
// use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // return ("<h1>hhelo</h1>");
});

Route::get("/posts/create", [PostController::class, 'create'])->name('posts.create');
Route::post("/posts", [PostController::class, 'store'])->name('posts.store');
Route::get("/posts", [PostController::class, 'index'])->name('posts.index');
Route::get("/posts/{id}", [PostController::class, 'show'])->name('posts.show');
Route::put("/posts/{id}", [PostController::class, 'update'])->name('posts.update');
Route::get("/posts/edit/{id}", [PostController::class, 'edit'])->name('posts.edit');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/createUsers', [PostController::class, 'createUsers'])->name('posts.createUser');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
