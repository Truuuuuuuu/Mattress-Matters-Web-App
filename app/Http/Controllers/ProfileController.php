<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $profile = User::with(['host', 'tenant'])->get();
        return view('profile.index', $profile);
    }

    public function show()
    {

    }
}
