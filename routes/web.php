<?php

use App\Http\Controllers\Auth\EmailRegisterController;
use App\Http\Controllers\Auth\GoogleRegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Host\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Tenant\HomeController;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\get;

//landing page
Route::get('/', function () {
    return view('welcome');
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


/*Route::get('/user-option', function() {
   return view('auth.email-register');
});*/



Route::group(['prefix' => 'auth'], function () {
    Route::get('{provider}/redirect', [SocialiteController::class, 'redirectToProvider'])->name('social.redirect');
    Route::get('{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])->name('social.callback');
});

//tenant routes
Route::middleware(['auth', 'role:tenant'])
    ->prefix('tenant')
    ->name('tenant.')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'index'])
            ->name('homepage');


    });
//host routes
Route::middleware(['auth', 'role:host'])
    ->prefix('host')
    ->name('host.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
    });

//Listings results
Route::get('/all-listings',[ListingController::class,'index'])->name('all.listings');
Route::get('/show-listing',[ListingController::class,'show'])->name('show.listing');

