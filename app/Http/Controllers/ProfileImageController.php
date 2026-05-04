<?php

namespace App\Http\Controllers;

use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfileImageController extends Controller
{
    public function __construct(protected CloudinaryService $cloudinary) {}

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = $request->user();

        // No need to delete old image — overwrite:true handles it in Cloudinary
        $data = $this->cloudinary->uploadProfileImage($request->file('image'), $user->id);

        $user->update([
            'profile_photo_public_id' => $data['cloudinary_public_id'],
        ]);

        Cache::forget("profile_image_{$user->id}");

        return response()->json([
            'profile_photo_url' => $user->profile_photo_url, // derived via accessor
        ]);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        if (!$user->profile_photo_public_id) {
            return response()->json(['message' => 'No profile image to delete.'], 404);
        }

        $this->cloudinary->deleteImage($user->profile_photo_public_id);

        $user->update(['profile_photo_public_id' => null]);

        Cache::forget("profile_image_{$user->id}");

        return response()->json(['message' => 'Profile image deleted.']);
    }
}
