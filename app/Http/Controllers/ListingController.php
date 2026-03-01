<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::with('host.user')->latest()->paginate(21);
        return view('listings.index', [
            'listings' => $listings
        ]);
    }

    public function show(Listing $listing){
        $listing->load('host.user');

        return view('listings.show', compact('listing'));
    }
}
