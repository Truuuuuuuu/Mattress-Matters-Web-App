<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('tenant.homepage');
    }
}
