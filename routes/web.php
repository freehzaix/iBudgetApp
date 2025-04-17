<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\isLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(isLogin::class);
Route::get('/profile', [UserController::class, 'profile'])->middleware(isLogin::class);
Route::put('/profile/{id}', [UserController::class, 'profile_update'])->middleware(isLogin::class)->name('profile');
Route::get('/logout', [UserController::class, 'logout'])->middleware(isLogin::class);

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('auth.handleLogin');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'handleRegister'])->name('auth.handleRegister');
