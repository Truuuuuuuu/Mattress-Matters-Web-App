<?php

use Illuminate\Support\Facades\Route;

//landing page
Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {

   return view('auth.login');
});

Route::get('/user-option', function() {
   return view('auth.user-option');
});

Route::get('/search', function() {
   dd('search triggered');
});
