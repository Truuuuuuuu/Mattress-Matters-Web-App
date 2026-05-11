<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::role(['host', 'tenant'])->count();
        $totalActiveTenants = Tenant::whereHas('rentals', function ($q) {
            $q->where('status', 'active');
        })->count();
        $totalActiveListings = Listing::where(['status' => 'active'])->count();

        $recentUsers = User::role(['host', 'tenant'])
            ->with('roles')
            ->latest()
            ->take(5)
            ->get();

        /*User growth graph*/
        $users = User::role(['host', 'tenant'])
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartData = [
            'labels' => $users->pluck('month'),
            'values' => $users->pluck('total'),
        ];

        return view('admin.dashboard', compact('totalUsers', 'totalActiveTenants', 'totalActiveListings', 'totalActiveTenants', 'recentUsers', 'chartData'));
    }

    public function manageUsers(Request $request)
    {
        $query = User::query()
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', ['host', 'tenant']);
            })
            ->with('roles')
            ->latest();

        // Search (name or email)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('role') && $request->role !== 'all') {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $allUsers = $query->paginate(15)->withQueryString();

        return view('admin.manage-users', compact('allUsers'));
    }
    public function manageListings(Request $request)
    {
        $query = Listing::query()
            ->with('host') // adjust if your relation name differs
            ->latest();

        // Search (title or address if exists)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Status filter (active, inactive, etc.)
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }


        $listings = $query->paginate(15)->withQueryString();

        return view('admin.manage-listings', compact('listings'));
    }
}
