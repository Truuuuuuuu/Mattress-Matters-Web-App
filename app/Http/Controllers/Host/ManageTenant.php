<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
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
            ->paginate(20, ['*'], 'activeTenants')->withQueryString();

        $movingOutTenants = Rental::with(['moveOutNotice.latestReversal','listing', 'tenant.user', 'reservation'])
            ->whereHas('moveOutNotice', fn($q) => $q->whereIn('status', ['active', 'completed', 'cancelled']))
            ->get()
            ->sortBy('moveOutNotice.move_out_date');


        $tenantHistory = Rental::with(['tenant.user', 'listing', 'moveOutNotice'])
            ->whereHas('listing', fn($q) => $q->where('host_id', $user->id))
            ->where('status', 'ended')
            ->latest()
            ->paginate(20,['*'], 'historyTenants')->withQueryString();

        $invoiceMonth = request('invoice_month');
        $invoiceStatus = request('invoice_status');

        $allInvoices = Invoice::with(['rental.listing', 'rental.tenant.user'])
            ->whereHas('rental.listing', fn($q) => $q->where('host_id', $user->id))
            ->when($invoiceStatus, fn($q) => $q->where('status', $invoiceStatus))
            ->when($invoiceMonth, fn($q) => $q->whereYear('period_month', substr($invoiceMonth, 0, 4))
                ->whereMonth('period_month', substr($invoiceMonth, 5, 2)))
            ->latest('due_date')
            ->paginate(20, ['*'], 'invoicePage')
            ->withQueryString();

        $invoiceMonths = Invoice::selectRaw('DATE_FORMAT(period_month, "%Y-%m") as month')
            ->whereHas('rental.listing', fn($q) => $q->where('host_id', $user->id))
            ->distinct()
            ->orderByRaw('month DESC')
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

}
