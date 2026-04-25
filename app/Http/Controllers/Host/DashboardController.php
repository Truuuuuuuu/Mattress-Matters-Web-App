<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Host;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $host = auth()->user()->host;
        return view('host.dashboard', Host::dashboardStats($host));
    }


}
