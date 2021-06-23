<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\userController;
use App\Http\Controllers\emailController;


Route::get('/',function(){return redirect('/posts');});
Route::get('/home',function(){return redirect('/posts');});


Route::get('/posts', [PostController::class, 'index']);
Route::view('/posts/create','posts.create');
Route::post('/posts', [PostController::class, 'store']);


Route::get('/posts/myPosts', [PostController::class, 'userPosts']);
Route::get('/posts/{id}', [PostController::class, 'show'])->name('post');
Route::post('/comments', [CommentController::class, 'store']);

Route::delete('/eliminar/{id}', [PostController::class, 'eliminar'])->name('post');

Route::get('/today/{id}', [PostController::class, 'show'])->name('post');
Route::get('/today/', [PostController::class, 'today']);

Route::get('/usuarios', [userController::class, 'show']);
Route::get('/usuarios/eliminar/{user}', [userController::class, 'eliminar'])->name('eliminar');
Route::post('/usuarios/{user}', [userController::class, 'editar'])->name('editar');


Route::get('/notificaciones', [CommentController::class, 'notificacion']);
Route::post('/notificaciones/leidas', [CommentController::class, 'leido']);



Auth::routes();

Route::get('/home', 
[App\Http\Controllers\PostController::class, 
'index'])->name('home');
