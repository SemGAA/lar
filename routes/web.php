<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('login',[UserController::class,'loginIndex'])->name('loginIndex');
Route::post('login',[UserController::class,'login'])->name('login');

Route::get('register',[UserController::class,'registerIndex'])->name('registerIndex');
Route::post('register',[UserController::class,'register'])->name('register');

Route::middleware('auth')->group(function(){
    Route::post('logout',[UserController::class,'logout'])->name('logout'); // ИСПРАВЛЕНО: POST вместо GET
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard.home');
    
    // Посты (доступны всем авторизованным пользователям)
    Route::prefix('dashboard/posts')->name('dashboard.posts.')->group(function(){
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });
});

// Админские маршруты
Route::middleware(['auth','admin'])->group(function(){
    Route::get('dashboard/users', [AdminController::class, 'usersIndex'])->name('dashboard.users.index');
    Route::delete('dashboard/users/{user}', [AdminController::class, 'usersDelete'])->name('dashboard.users.delete');
    
    // Категории (только для админов)
    Route::prefix('dashboard/categories')->name('dashboard.categories.')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

Route::get('secret', function(){
    return 'ssdfsdfsd';
})->middleware('secret');