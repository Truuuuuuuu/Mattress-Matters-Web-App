<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

//landing page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth.placeholder', function () {
    return view('auth.placeholder');
})->middleware('auth');


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login',[SessionController::class, 'store']);
});

Route::delete('/logout',[SessionController::class, 'destroy']);


Route::get('/user-option', function() {
   return view('auth.user-option');
});

Route::get('/search', function() {
   dd('search triggered');
});
