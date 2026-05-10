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
}
