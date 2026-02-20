<?php

use Illuminate\Support\Facades\Route;

//landing page
Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {

   return view('auth.login');
});

Route::get('/register', function() {
   return view('auth.register');
});

Route::get('/search', function() {
   dd('search triggered');
});
