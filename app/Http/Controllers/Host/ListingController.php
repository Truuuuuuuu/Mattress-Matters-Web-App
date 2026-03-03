<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(){

        return view('host.listings');
    }

    public function create(){

        $amenities = Amenity::all();
        return view('host.create', compact('amenities'));
    }
}
