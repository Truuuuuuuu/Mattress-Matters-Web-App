<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Listing;
use App\Models\Rule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $listings = Listing::with('host.user')
            ->latest()
            ->filter($request->only('search'))
            ->paginate(21)
            ->withQueryString();
        $amenities = Amenity::all();
        $rules = Rule::where('category', 'gender')
            ->orWhere('category', 'tenant')
            ->get();



        return view('listings.index', compact('listings', 'amenities', 'rules'));
    }
}
