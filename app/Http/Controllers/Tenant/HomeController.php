<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;

class HomeController extends Controller
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
}
