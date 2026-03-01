<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(){
        return view('host.listings');
    }

    public function create(){
        return view('host.create');
    }
}
