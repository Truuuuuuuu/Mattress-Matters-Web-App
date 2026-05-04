<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Listing;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function __construct(protected CloudinaryService $cloudinary) {}
    public function index()
    {
        $user = auth()->user();

        $profile = $user->getProfile();
        abort_if(is_null($profile), 404);


        return view('profile.index', compact('profile'));
    }

    public function show(User $user)
    {
        $profile = $user->getProfile();
        abort_if(is_null($profile), 404);


        return view('profile.show', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = $request->user();

        $user->update(['name' => $request->name]);

        if ($request->hasFile('image')) {
            $data = $this->cloudinary->uploadProfileImage($request->file('image'), $user->id);
            $user->update(['profile_photo_public_id' => $data['cloudinary_public_id']]);
            Cache::forget("profile_image_{$user->id}");
        }

        return response()->json([
            'name'              => $user->name,
            'profile_photo_url' => $user->profile_photo_url,
        ]);
    }
}
