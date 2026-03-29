<?php

use App\Http\Controllers\Auth\EmailRegisterController;
use App\Http\Controllers\Auth\GoogleRegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Host\DashboardController;
use App\Http\Controllers\Host\ListingController;
use App\Http\Controllers\Host\ManageTenant;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResultListingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Tenant\HomeController;
use App\Http\Controllers\Tenant\UnitController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\get;

//landing page
Route::get('/', function () {
    $listings = Listing::with('ListingImages')
        ->latest()
        ->take(4)
        ->get();
    return view('welcome',[
        'listings' => $listings
    ]);
});


Route::middleware('guest')->group(function () {
    Route::get('/google-register', [GoogleRegisterController::class, 'create'])->name('google.register');
    Route::post('/google-register', [GoogleRegisterController::class, 'store']);

    Route::get('/email-register', [EmailRegisterController::class, 'create'])->name('email.register');
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

        Route::get('/my-unit', [UnitController::class, 'index'])
            ->name('unit');
        Route::post('/my-unit/{rental}/move-out', [UnitController::class, 'store'])
            ->name('moveOutNotice.store');
        Route::patch('/my-unit/{rental}/cancel-move-out', [UnitController::class, 'update'])
            ->name('moveOutNotice.update');

        Route::post('/reservations/store/{listing}', [ReservationController::class, 'store'])
            ->name('reservations.store');


    });
//host routes
Route::middleware(['auth', 'role:host'])
    ->prefix('host')
    ->name('host.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::get('/host-listings', [ListingController::class, 'index'])
            ->name('listings');
        Route::get('/host-create', [ListingController::class, 'create'])
            ->name('create');
        Route::post('/host-store', [ListingController::class, 'store'])
            ->name('store');
        Route::get('/host-show/{listing}', [ListingController::class, 'show'])
            ->name('show');
        Route::get('/host-edit/{listing}', [ListingController::class, 'edit'])
            ->name('edit');
        Route::patch('/host-update/{listing}', [ListingController::class, 'update'])
            ->name('update');
        Route::delete('/host-delete/{listing}', [ListingController::class, 'destroy'])
            ->name('delete');
        Route::get('/tenants/index', [ManageTenant::class, 'index'])
            ->name('tenants.index');
        Route::get('/tenants/{tenant}/show', [ManageTenant::class, 'show'])
            ->name('tenants.show');
    });

/*Reservation*/
Route::middleware(['auth', 'permission:cancel reservations'])
    ->prefix('reservation')
    ->name('reservation.')
    ->group(function () {
        Route::get('/reservations', [ReservationController::class, 'index'])
            ->name('index');
        Route::get('/{reservation}', [ReservationController::class, 'show'])
            ->name('show');
        Route::patch('/{reservation}/cancel', [ReservationController::class, 'cancel'])
            ->name('cancel');
        Route::patch('/{reservation}/decline', [ReservationController::class, 'decline'])
            ->name('decline');
        Route::patch('/{reservation}/accept', [ReservationController::class, 'accept'])
            ->name('accept');
        Route::patch('/{reservation}/checkedIn', [ReservationController::class, 'checkedIn'])
            ->name('checkedIn');

    });

/*Payment Sandbox using XENDIT*/
Route::post('/payment/{reservation}/gcash', [PaymentController::class, 'createGcashPayment'])->name('payment.gcash');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
Route::post('/payment/webhook', [PaymentController::class, 'webhook'])->name('payment.webhook');

/*Profile*/
Route::middleware(['auth', 'permission:view profile'])
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('index');
        Route::get('/{user}/show', [ProfileController::class, 'show'])
            ->name('show');
    });
//Listings results
Route::get('/listings',[ResultListingController::class,'index'])->name('listings.index');

Route::get('/listings/{listing}', [ResultListingController::class, 'show'])->name('listings.show');

//Settings
Route::middleware('auth')
    ->prefix('settings')
    ->name('settings.')
    ->group(function (){
       Route::get('/settings/index', [SettingsController::class, 'index'])
           ->name('index');
       Route::post('/theme', [SettingsController::class, 'updateTheme'])
           ->name('theme');
    });


Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
