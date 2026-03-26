<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Reservation;
use App\Models\Tenant;
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

    public function show(Tenant $tenant)
    {
        $tenant->load([
            'user',
            'rentals' => fn($q) => $q->where('status', 'active')->with('listing')
        ]);

        return view('host.tenants.show', compact('tenant'));
    }

}
