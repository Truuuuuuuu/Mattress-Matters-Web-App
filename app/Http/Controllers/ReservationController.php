<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();

        if($user->hasRole('host')){
            $reservations = Reservation::latest()->paginate(10);
            return view('host.reservations', compact('reservations'));
        }

        $activeReservation = Reservation::with(['listing.listingImages' => fn($q) => $q->where('is_cover', true)])
        ->where('tenant_id', $user->tenant->id)
        ->whereIn('status', ['pending', 'approved', 'checked_in'])
        ->latest()
        ->first();

        $allReservations = Reservation::with(['listing.listingImages' => fn($q) => $q->where('is_cover', true)])
            ->where('tenant_id', $user->tenant->id)
            ->whereIn('status', ['rejected', 'cancelled', 'completed'])
            ->latest()
            ->paginate(10);

        return view('tenant.reservation.index', compact('activeReservation', 'allReservations'));
    }

    public function show()
    {

    }

    public function store(Listing $listing , Request $request)
    {
        $tenant = auth()->user()->tenant;

        $hasActive = Reservation::where('tenant_id', $tenant->id)
            ->whereIn('status',['pending', 'approved'])
            ->exists();


        if($hasActive){
            return redirect()->route('tenant.reservations.index')
                ->with('error', 'You already have an active reservation');
        }

        $genderRule = $listing->rules()
            ->whereIn('title', ['male_only', 'female_only'])
            ->first();

        if($genderRule){
            $requiredGender = $genderRule->title === 'male_only' ? 'male' : 'female';

            if($requiredGender !== $tenant->gender){
                return redirect()->route('listings.show', $listing)
                    ->with('error', 'Gender mismatched');
            }
        }

        $occupationRule = $listing->rules()
            ->whereIn('title', ['students_only', 'working_individuals'])
            ->first();

        if($occupationRule){
            $requiredOccupation = $occupationRule->title === 'students_only' ? 'student' : 'working_individual';

            if($requiredOccupation !== $tenant->occupation){
                return redirect()->route('listings.show', $listing)
                    ->with('error', 'Occupation mismatched');
            }
        }



        $attributes = $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
        ]);

        Reservation::create([
            'tenant_id' => $tenant->id,
            'listing_id' => $listing->id,
            'start_date' => $attributes['start_date'],
            'end_date' => $attributes['end_date'],
        ]);


        return redirect()->route('listings.show', $listing)
            ->with('success', 'Reservation created');
    }


    public function cancel(Reservation $reservation)
    {
        $this->authorize('cancel reservations');

        $reservation->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Reservation cancelled');
    }

    public function approve()
    {

    }

    public function reject()
    {

    }




}
