<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Listing;

class HomeController extends Controller
{
    public function index()
    {
        $listings = Listing::latest()
            ->with('host')
            ->take(20)
            ->get();
        return view('tenant.homepage', [
            'listings' => $listings
        ]);
    }
}
