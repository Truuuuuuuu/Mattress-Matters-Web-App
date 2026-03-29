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

        $movingOutTenants = Rental::with(['moveOutNotice','listing', 'tenant.user'])
            ->whereHas('moveOutNotice', fn($q) => $q->where('status', 'active'))
            ->get()
            ->sortBy('moveOutNotice.move_out_date');


        $moveOutHistory = Rental::with([
            'moveOutNotices' => fn($q) => $q->whereIn('status', ['cancelled', 'completed'])
                ->with(['rental.listing', 'rental.tenant.user']), // eager load rental relationships
            'tenant.user',
            'listing'
        ])
            ->whereHas('moveOutNotices', fn($q) => $q->whereIn('status', ['cancelled', 'completed']))
            ->get()
            ->flatMap(fn($rental) => $rental->moveOutNotices)
            ->sortByDesc('move_out_date');


        return view('host.tenants.index', compact(['myTenants', 'movingOutTenants', 'moveOutHistory']));
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
