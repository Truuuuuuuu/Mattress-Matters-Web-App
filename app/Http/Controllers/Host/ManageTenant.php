<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ManageTenant extends Controller
{
    public function index()
    {

        $user =  auth()->user();
        $myTenants = Rental::with(['listing', 'tenant.user'])
            ->whereHas('listing', fn($q) => $q->where('host_id', $user->id))
            ->where('status', 'active')
            ->latest()
            ->paginate(3);

        return view('host.tenants.index', compact('myTenants'));
    }

    public function show()
    {
        return view('host.tenants.show');
    }

}
