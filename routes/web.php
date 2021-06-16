<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\Admin\PostController as Post;
use App\Http\Controllers\Api\PostController as PostApi;
use App\Http\Controllers\Api\CategoryController as CategoryApi;
use App\Http\Controllers\Web\Admin\CategoryController;

Route::prefix('/')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{post}', [PostController::class, 'show']);
});

Route::middleware(['auth', 'verified'])->prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('/posts')->group(function () {
        Route::get('/', [Post::class, 'index']);
        Route::get('/create', [Post::class, 'create']);
        Route::get('/show/{post}', [Post::class, 'show']);
    });

    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
    });

    Route::prefix('/api')->group(function () {
        Route::prefix('/posts')->group(function () {
            Route::post('/search', [PostApi::class, 'search'])->name('posts.search');
            Route::post('/create', [PostApi::class, 'store'])->name('posts.create');
            Route::post('/update/{post}', [PostApi::class, 'update'])->name('posts.update');
            Route::post('/delete/{post}', [PostApi::class, 'destroy'])->name('posts.delete');
        });

        Route::prefix('/categories')->group(function () {
            Route::post('/create', [CategoryApi::class, 'store'])->name('categories.create');
            Route::post('/update/{category}', [CategoryApi::class, 'update'])->name('categories.update');
            Route::post('/delete/{category}', [CategoryApi::class, 'destroy'])->name('categories.delete');
        });
    });
});

require __DIR__.'/auth.php';
