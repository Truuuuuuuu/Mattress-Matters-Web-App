<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class EmailRegisterController extends Controller
{
    public function create(){
        return view('auth.email-register');
    }

    public function store(Request $request){

        $attributes = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'role' => ['required', 'in:host,tenant']
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => $attributes['password'],
        ]);

        /*Assign the user*/
        $user->assignRole($attributes['role']);

        Auth::login($user);

        if($user->hasRole('host')){
            return redirect()->route('host.dashboard');
        }

        return redirect()->route('tenant.homepage');
    }
}
