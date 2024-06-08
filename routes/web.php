<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'posts.index')->name('home');

//group middleware for auth access just to be sure just put auth first then guest i might be a top down thing
Route::middleware('auth')->group(function (){
    /* dashboard */
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    /* logout */
   Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});
//group middleware for guest access
Route::middleware('guest')->group(function (){
    /* register */
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    /* login */
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

