<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\MoveOutNotice;
use App\Models\Rental;
use Carbon\Carbon;
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

        $tenant = auth()->user()->tenant;

        // Get invoice status information
        $invoiceInfo = [];
        if ($tenant->rental?->invoices->count() > 0) {
            // Get the latest invoice (paid or unpaid)
            $latestInvoice = $tenant->rental->invoices->sortByDesc('created_at')->first();

            if ($latestInvoice->status === 'paid') {
                $invoiceInfo = [
                    'status' => 'paid',
                    'due_date' => null,
                ];
            } elseif ($latestInvoice->status === 'unpaid') {
                // Check if overdue
                $isOverdue = $latestInvoice->due_date < now();

                $invoiceInfo = [
                    'status' => $isOverdue ? 'overdue' : 'unpaid',
                    'due_date' => $latestInvoice->due_date,
                    'invoice' => $latestInvoice,
                    'is_overdue' => $isOverdue,
                    'days_overdue' => $isOverdue ? $latestInvoice->due_date->diffInDays(now()) : 0,
                ];
            }
        } else {
            // No invoice yet (first time)
            $invoiceInfo = [
                'status' => 'no_invoice',
                'due_date' => null,
            ];
        }



        return view('tenant.my-unit', compact('myUnit', 'invoiceInfo'));
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
