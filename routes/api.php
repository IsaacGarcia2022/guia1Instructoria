<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\LibroController;
use App\Http\Controllers\Api\PrestamoController;
use App\Http\Controllers\Api\AutorController;
use App\Http\Controllers\Api\CategoriaController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    
    Route::prefix('auth')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    // CRUD de la Biblioteca (Tu tarea principal)
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('autores', AutorController::class);
    Route::apiResource('libros', LibroController::class);
    Route::apiResource('prestamos', PrestamoController::class);

    // Usuarios
    Route::apiResource('users', UserController::class);

    // Posts (Mantenemos el prefix aquí porque tienes rutas extra como 'my-posts')
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/my-posts', [PostController::class, 'myPosts']);
        Route::get('/{post}', [PostController::class, 'show']);
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}', [PostController::class, 'update']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
        
        // Tags de los posts
        Route::post('/{post}/tags', [PostController::class, 'updateTags']);
        Route::delete('/{post}/tags', [PostController::class, 'detachTags']);
    });
});