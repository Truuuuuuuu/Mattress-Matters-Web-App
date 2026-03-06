<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Rule;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(){

        return view('host.listings');
    }

    public function create(){

        $amenities = Amenity::all();

        /*Rules*/
        $petRules = Rule::where('category', 'pet')->get();
        $curfewRules = Rule::where('category', 'curfew')->get();
        $smokingRules = Rule::where('category', 'smoking')->get();
        $guestRules = Rule::where('category', 'guest')->get();
        return view('host.create', compact('amenities', 'petRules', 'curfewRules', 'smokingRules', 'guestRules'));
    }

    public function store(Request $request){
        dd('store logic');
    }
}
