<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Host;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class GoogleRegisterController extends Controller
{
    public function create(){
        return view('auth.google-register',[
            'fullName' => session('google_fullName'),
            'email' => session('google_email'),
            'provider_id' => session('google_provider_id')
        ]);
    }

    public function store(Request $request){

        $attributes = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role'  => ['required', 'in:host,tenant'],
            'gender' => ['nullable','required if:role,tenant', 'in:male,female'],
            'occupation' => ['nullable', 'required if:role,tenant', 'in:student,working_individual'],
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

        if($attributes['role'] === 'tenant'){
            Tenant::create([
                'user_id' => $user->id,
                'gender' => $attributes['gender'],
                'occupation' => $attributes['occupation'],
            ]);
        }

        session()->forget(['google_fullName', 'google_email', 'google_provider_id']);

        Auth::login($user);

        if($user->hasRole('host')){
            return redirect()->route('host.dashboard');
        }
        return redirect()->route('tenant.homepage');
    }
}
