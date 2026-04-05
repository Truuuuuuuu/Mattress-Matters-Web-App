<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Listing;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $profile = $user->getProfile();
        abort_if(is_null($profile), 404);


        return view('profile.index', compact('profile'));
    }

    public function show(User $user)
    {
       if($user->hasRole('tenant')){
           $userProfile = Tenant::where('user_id', $user->id)->first();
           return view('profile.show', compact('userProfile'));
       }
       $userProfile = Host::where('user_id', $user->id)
           ->withCount('listings')
           ->first();


        return view('profile.show', compact( 'userProfile'));
    }
}
