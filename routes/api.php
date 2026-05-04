<?php


use App\Http\Controllers\ListingImageController;
use App\Http\Controllers\ProfileImageController;

Route::middleware(['auth:sanctum', 'throttle:image-upload'])->group(function () {
    Route::get('/listings/{listing}/images', [ListingImageController::class, 'index']);
    Route::post('/listings/{listing}/images', [ListingImageController::class, 'store']);
    Route::put('/listings/{listing}/images/{image}', [ListingImageController::class, 'update']);
    Route::delete('/listings/{listing}/images/{image}', [ListingImageController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'throttle:profile-upload'])->group(function () {
    Route::post('/user/profile-image', [ProfileImageController::class, 'store'])->name('profile.image.store');
    Route::delete('/user/profile-image', [ProfileImageController::class, 'destroy']);
});
