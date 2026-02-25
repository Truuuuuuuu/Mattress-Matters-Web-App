<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

        Auth::login($user);

        return redirect('/auth.homepage');
    }
}
