<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\MoveOutNotice;
use App\Models\Rental;
use App\Models\Reservation;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ManageTenant extends Controller
{
    public function index()
    {
        $user =  auth()->user();

        $myTenants = Rental::with(['listing', 'tenant.user'])
            ->whereHas('listing.host', fn($q) => $q->where('user_id', $user->id))
            ->where('status', 'active')
            ->latest()
            ->paginate(20, ['*'], 'activeTenants')->withQueryString();

        $movingOutTenants = Rental::with(['moveOutNotice.latestReversal','listing', 'tenant.user', 'reservation'])
            ->whereHas('listing.host', fn($q) => $q->where('user_id', $user->id))
            ->whereHas('moveOutNotice', fn($q) => $q->whereIn('status', ['active', 'completed', 'cancelled']))
            ->get()
            ->sortBy('moveOutNotice.move_out_date');


        $tenantHistory = Rental::with(['tenant.user', 'listing', 'moveOutNotice'])
            ->whereHas('listing.host', fn($q) => $q->where('user_id', $user->id))
            ->where('status', 'ended')
            ->latest()
            ->paginate(20,['*'], 'historyTenants')->withQueryString();

        $invoiceMonth = request('invoice_month');
        $invoiceStatus = request('invoice_status');

        $allInvoices = Invoice::with(['rental.listing', 'rental.tenant.user'])
            ->whereHas('rental.listing.host', fn($q) => $q->where('user_id', $user->id))
            ->when($invoiceStatus, fn($q) => $q->where('status', $invoiceStatus))
            ->when($invoiceMonth, fn($q) => $q->where('period_month', $invoiceMonth)) // ← simple string match
            ->latest('due_date')
            ->paginate(20, ['*'], 'invoicePage')
            ->withQueryString();

        $invoiceMonths = Invoice::selectRaw('period_month as month') // ← no DATE_FORMAT needed
        ->whereHas('rental.listing.host', fn($q) => $q->where('user_id', $user->id))
            ->distinct()
            ->orderByDesc('period_month')
            ->get()
            ->pluck('month');

        return view('host.tenants.index', compact(['myTenants', 'movingOutTenants', 'tenantHistory', 'invoiceMonths', 'allInvoices']));
    }

    public function show(Rental $rental, Request $request)
    {
        $rental->load(['tenant.user', 'listing', 'reservation']);

        // Desktop modal fetch
        if ($request->header('X-Modal-Request')) {
            return view('host.tenants.partials.show-content', compact('rental'));
        }

        return view('host.tenants.show', compact('rental'));
    }

    public function viewSOA(Tenant $tenant)
    {
        $myUnit = Rental::where('tenant_id', $tenant->id)
            ->whereHas('reservation', fn($q) => $q->whereIn('status', ['accepted', 'checked_in'])
                ->where('payment_status', 'paid'))
            ->where('status', 'active')
            ->with(['listing.listingImages', 'listing.amenities', 'listing.rules', 'moveOutNotice'])
            ->first();

        // Get invoice status information
        $invoiceInfo = [];
        if ($tenant->rental?->invoices->count() > 0) {
            $latestInvoice = $tenant->rental->invoices->sortByDesc('created_at')->first();

            if ($latestInvoice->status === 'paid') {
                $invoiceInfo = [
                    'status'   => 'paid',
                    'due_date' => null,
                    'month'    => Carbon::parse($latestInvoice->due_date)->format('M'),
                ];
            } elseif (in_array($latestInvoice->status, ['unpaid', 'overdue'])) {
                $isOverdue = $latestInvoice->status === 'overdue'
                    || $latestInvoice->due_date < now();

                $invoiceInfo = [
                    'status'       => $isOverdue ? 'overdue' : 'unpaid',
                    'due_date'     => $latestInvoice->due_date,
                    'invoice'      => $latestInvoice,
                    'is_overdue'   => $isOverdue,
                    'days_overdue' => $isOverdue ? $latestInvoice->due_date->diffInDays(now()) : 0,
                ];
            }
        } else {
            $invoiceInfo = [
                'status'   => 'no_invoice',
                'due_date' => null,
            ];
        }

        $rental = $tenant->rental;

        if (!$rental) {
            return view('host.tenants.partials.view-soa', [
                'invoices'    => collect(),
                'rental'      => null,
                'nextDue'     => null,
                'myUnit'      => $myUnit,
                'invoiceInfo' => $invoiceInfo,
                'tenant'      => $tenant,
            ]);
        }

        $nextDue = $rental->invoices()
            ->where('status', 'unpaid')
            ->orderBy('due_date')
            ->first()
            ?->due_date;

        $invoices = $rental->invoices()
            ->orderBy('due_date', 'desc')
            ->get();

        return view('host.tenants.partials.view-soa', compact('myUnit', 'invoiceInfo', 'invoices', 'rental', 'nextDue', 'tenant'));
    }
}
