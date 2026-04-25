<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\MoveOutNotice;
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

        $movingOutTenants = Rental::with(['moveOutNotice','listing', 'tenant.user', 'reservation'])
            ->whereHas('moveOutNotice', fn($q) => $q->where('status', 'active'))
            ->get()
            ->sortBy('moveOutNotice.move_out_date');


        $tenantHistory = Rental::with(['tenant.user', 'listing'])
            ->whereHas('listing', fn($q) => $q->where('host_id', $user->id))
            ->where('status', 'ended')
            ->latest()
            ->paginate(3);


        return view('host.tenants.index', compact(['myTenants', 'movingOutTenants', 'tenantHistory']));
    }

    public function show(Tenant $tenant)
    {
        $tenant->load([
            'user',
            'rentals' => fn($q) => $q->with(['listing', 'reservation'])->latest()
        ]);

        return view('host.tenants.show', compact('tenant'));
    }

}
