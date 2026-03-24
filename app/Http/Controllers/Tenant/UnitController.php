<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(){
        $user = auth()->user()->tenant->id;

        $myUnit = Rental::where('tenant_id', $user)
        ->where('status', 'active')
        ->with(['listing.listingImages', 'listing.amenities', 'listing.rules'])
        ->first();



        return view('tenant.my-unit', compact('myUnit'));
    }
}
