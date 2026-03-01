<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Host;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class GoogleRegisterController extends Controller
{
    public function create(){
        return view('auth.google-register',[
            'fullName' => session('fullName'),
            'email' => session('email'),
            'provider_id' => session('provider_id')
        ]);
    }

    public function store(Request $request){

        $attributes = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role'  => ['required', 'in:host,tenant'],
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => null,
            'google_id' => $request->provider_id
        ]);

        /*Assign the user*/
        $user->assignRole($attributes['role']);

        /*Create in Host table*/
        if($attributes['role'] === 'host'){
            Host::create([
                'user_id' => $user->id,
            ]);
        }

        Auth::login($user);

        if($user->hasRole('host')){
            return redirect()->route('host.dashboard');
        }
        return redirect()->route('tenant.homepage');
    }
}
