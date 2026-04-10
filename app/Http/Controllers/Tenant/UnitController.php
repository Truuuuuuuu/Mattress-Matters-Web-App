<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\MoveOutNotice;
use App\Models\Rental;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(){
        $user = auth()->user()->tenant->id;

        $myUnit = Rental::where('tenant_id', $user)
            ->whereHas('reservation', fn($q) => $q->whereIn('status', ['accepted', 'checked_in'])
            ->where('payment_status', 'paid'))
            ->where('status', 'active')
            ->with(['listing.listingImages', 'listing.amenities', 'listing.rules', 'moveOutNotice'])
            ->first();

        $tenant  = auth()->user()->tenant;
        $rental  = $tenant->rental;
        $moveInDay = \Carbon\Carbon::parse($rental?->lease_start_date)->day;
        $today     = \Carbon\Carbon::today();
        $dueDate   = $today->copy()->startOfMonth()->setDay($moveInDay);

        $nextDue = $today->gt($dueDate)
            ? $dueDate->copy()->addMonth()
            : $dueDate;

        // First month is paid on reservation, so nextDue can't be earlier than lease_start + 1 month
        $firstDue = \Carbon\Carbon::parse($rental?->lease_start_date)->addMonth();
        if ($nextDue->lt($firstDue)) {
            $nextDue = $firstDue;
        }

        return view('tenant.my-unit', compact('myUnit', 'nextDue'));
    }

    public function store(Rental $rental, Request $request) {
        $attributes = $request->validate([
            'move_out_date' => ['required', 'date',
                'after:' . now()->addDays(7)->toDateString(),
                'before_or_equal:' . now()->addDays(30)->toDateString(),],
            'reason' => ['nullable', 'string']
        ]);

        /*traditional*/
        /*MoveOutNotice::create([
            'rental_id' => $rental->id,
            'move_out_date' => $attributes['move_out_date'],
            'reason' => $attributes['reason'],
        ]);*/

        /*another approach*/
        MoveOutNotice::create(array_merge($attributes, ['rental_id' => $rental->id]));

        return redirect()->route('tenant.unit')->with('success', 'Move out notice has been created.');
    }

    public function update(Rental $rental){
        $rental->moveOutNotice->update([
            'status' => 'cancelled',
            'cancelled_at' => now()
        ]);

        return redirect()->route('tenant.unit')->with('success', 'Move out notice has been cancelled.');
    }


}
