<?php

use Illuminate\Support\Facades\Route;

//landing page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {

   dd('login');
});

Route::get('/register', function() {
   dd('register');
});

Route::get('/search', function() {
   dd('search triggered');
});
