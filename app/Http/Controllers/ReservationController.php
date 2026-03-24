<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();

        if($user->hasRole('host')){
            $pendingReservations = Reservation::with([
                'listing',
                'tenant.user'
            ])
            ->whereHas('listing', fn($q) => $q->where('host_id', $user->id))
            ->where('status', 'pending')
            -> latest()
            ->paginate(10);

            $acceptedReservations = Reservation::with([
                'listing',
                'tenant.user'
            ])
                ->whereHas('listing', fn($q) => $q->where('host_id', $user->id))
                ->where('status', 'accepted')
                -> latest()
                ->paginate(10);

            $historyReservations = Reservation::with([
                'listing',
                'tenant.user'
            ])
                ->whereHas('listing', fn($q) => $q->where('host_id', $user->id))
                ->whereIn('status', ['declined', 'cancelled', 'completed', 'expired', 'checked_in'])
                -> latest()
                ->paginate(10);

            return view('host.reservation.index', compact('pendingReservations', 'acceptedReservations', 'historyReservations'));
        }



        $activeReservation = Reservation::with(['listing.listingImages' => fn($q) => $q->where('is_cover', true)])
        ->where('tenant_id', $user->tenant->id)
        ->whereIn('status', ['pending', 'accepted'])
        ->latest()
        ->first();

        $allReservations = Reservation::with(['listing.listingImages' => fn($q) => $q->where('is_cover', true)])
            ->where('tenant_id', $user->tenant->id)
            ->whereIn('status', ['declined', 'cancelled','checked_in',  'completed' , 'expired'])
            ->latest()
            ->paginate(10);

        return view('tenant.reservation.index', compact('activeReservation', 'allReservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load([
            'listing.listingImages' => fn($q) => $q->where('is_cover', true),
            'tenant.user'
        ]);

        return view('host.reservation.show', compact('reservation'));
    }

    public function store(Listing $listing , Request $request)
    {
        $tenant = auth()->user()->tenant;

        $hasActive = Reservation::where('tenant_id', $tenant->id)
            ->whereIn('status',['pending', 'accepted', 'checked_in'])
            ->exists();


        if($hasActive){
            return redirect()->route('reservation.index')
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


        return redirect()->route('reservation.index')
            ->with('success', 'Reservation created');
    }


    public function cancel(Reservation $reservation)
    {
        $this->authorize('cancel reservations');

        $reservation->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('reservation.index')->with('success', 'Reservation cancelled');
    }

    public function decline(Reservation $reservation)
    {
        $reservation->update([
           'status' => 'declined'
        ]);

        return redirect()->route('reservation.index')->with('success', 'Reservation declined');

    }

    public function accept(Reservation $reservation)
    {
        $reservation->update([
           'status' => 'accepted'
        ]);

        return redirect()->route('reservation.index')->with('success', 'Reservation accepted');
    }

    public function checkedIn(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'checked_in'
        ]);

        return redirect()->route('reservation.index')->with('success', 'Enjoy your stay!');
    }

}
