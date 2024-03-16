<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\LoginController;

// User Registration
Route::get('/', [CustomRegisterController::class, 'showRegistrationForm']); // Redirect root URL to registration page
Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [CustomRegisterController::class, 'register']);

// User Login
Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login']);

// home page
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
