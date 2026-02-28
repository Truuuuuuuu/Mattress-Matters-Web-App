<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::with('host.user')->latest()->simplePaginate(21);
        return view('listings.index', [
            'listings' => $listings
        ]);
    }

    public function show(){
        return view('listings.show');
    }
}
