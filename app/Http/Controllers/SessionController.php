<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }


    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        /*if(! Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }*/

        $user = User::where('email', $attributes['email'])->first();

        //Check email
        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'Email does not exist.',
            ]);
        }

        // Check password
        if (! Hash::check($attributes['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'Incorrect password.',
            ]);
        }

        request()->session()->regenerate();

        Auth::login($user);

        return redirect('auth.placeholder');
    }

    public function destroy(){
        Auth::logout();

        return redirect('/');
    }
}
