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
            ->whereHas('reservation', fn($q) => $q->where('status', 'checked_in'))
            ->where('status', 'active')
            ->with(['listing.listingImages', 'listing.amenities', 'listing.rules'])
            ->first();


        return view('tenant.my-unit', compact('myUnit'));
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


}
