<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ResultListingController extends Controller
{
    public function index(Request $request)
    {
       $listings = Listing::with('host.user')
           ->latest()
           ->filter($request->only(['search', 'min_price', 'max_price']))
           ->paginate(21)
           ->withQueryString();

       return view('listings.index', compact('listings'));
    }

    public function show(Listing $listing){
        $listing->load('host.user');

        return view('listings.show', compact('listing'));
    }

}
