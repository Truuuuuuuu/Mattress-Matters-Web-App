<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ListingImageController extends Controller
{
    public function __construct(protected CloudinaryService $cloudinary) {}

    public function index(Listing $listing)
    {
        $images = Cache::remember(
            "listing_images_{$listing->id}",
            now()->addHours(6),
            fn () => $listing->images()->get()
        );

        return response()->json($images); // includes derived 'url' via accessor
    }

    public function store(Request $request, Listing $listing)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if (!$listing->canAddMoreImages()) {
            return response()->json([
                'message' => 'Maximum of ' . Listing::MAX_IMAGES . ' images allowed per listing.',
            ], 422);
        }

        $data = $this->cloudinary->uploadListingImage($request->file('image'), $listing->id);

        $image = ListingImage::create([
            'listing_id'           => $listing->id,
            'cloudinary_public_id' => $data['cloudinary_public_id'],
            'sort_order'           => $listing->images()->count(),
        ]);

        Cache::forget("listing_images_{$listing->id}");

        return response()->json($image, 201); // includes derived 'url'
    }

    public function update(Request $request, Listing $listing, ListingImage $image)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $data = $this->cloudinary->updateListingImage(
            $image->cloudinary_public_id,
            $request->file('image'),
            $listing->id
        );

        $image->update(['cloudinary_public_id' => $data['cloudinary_public_id']]);

        Cache::forget("listing_images_{$listing->id}");

        return response()->json($image);
    }

    public function destroy(Listing $listing, ListingImage $image)
    {
        $this->cloudinary->deleteImage($image->cloudinary_public_id);
        $image->delete();

        Cache::forget("listing_images_{$listing->id}");

        return response()->json(['message' => 'Image deleted.']);
    }
}
