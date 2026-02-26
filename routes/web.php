<?php

use App\Http\Controllers\Auth\EmailRegisterController;
use App\Http\Controllers\Auth\GoogleRegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Host\DashboardController;
use App\Http\Controllers\Tenant\HomeController;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\get;

//landing page
Route::get('/', function () {
    return view('welcome');
});

//tenant homepage
Route::middleware(['auth'])
    ->get('/home', [HomeController::class, 'index'])
    ->name('tenant.homepage');

//host dashboard
Route::middleware(['auth', 'role:host'])
    ->prefix('host')
    ->name('host.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});


Route::middleware('guest')->group(function () {
    Route::get('/google-register', [GoogleRegisterController::class, 'create'])->name('google-register');
    Route::post('/google-register', [GoogleRegisterController::class, 'store']);

    Route::get('/email-register', [EmailRegisterController::class, 'create']);
    Route::post('/email-register', [EmailRegisterController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login',[SessionController::class, 'store']);
});

Route::delete('/logout',[SessionController::class, 'destroy']);


Route::get('/user-option', function() {
   return view('auth.email-register');
});

Route::get('/search', function() {
   dd('search triggered');
});



Route::group(['prefix' => 'auth'], function () {
    Route::get('{provider}/redirect', [SocialiteController::class, 'redirectToProvider'])->name('social.redirect');
    Route::get('{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])->name('social.callback');
});
