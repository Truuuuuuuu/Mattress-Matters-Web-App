<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Listing;
use App\Models\Rule;
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

        $amenities = Amenity::all();
        $rules = Rule::where('category', 'gender');


       return view('listings.index', compact('listings', 'amenities', 'rules'));
    }

    public function show(Listing $listing){
        $listing->load('host.user');

        return view('listings.show', compact('listing'));
    }

}
