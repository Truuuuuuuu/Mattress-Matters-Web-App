<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CloudinaryService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary(
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
                'url' => [
                    'secure' => true,
                ],
            ])
        );
    }

    // ─── URL HELPER ───────────────────────────────────────────────

    public function getSecureUrl(string $publicId): string
    {
        return $this->cloudinary->image($publicId)->toUrl();
    }

    // ─── LISTING IMAGES ───────────────────────────────────────────

    public function uploadListingImage(UploadedFile $file, int $listingId): array
    {
        $publicId = "listings/listing_{$listingId}/" . Str::uuid();

        $result = $this->cloudinary->uploadApi()->upload($file->getRealPath(), [
            'public_id'      => $publicId,
            'overwrite'      => false,
            'resource_type'  => 'image',
            'transformation' => [
                ['width' => 1280, 'height' => 960, 'crop' => 'limit'],
                ['quality' => 'auto:good'],
                ['fetch_format' => 'auto'],
            ],
            'tags' => ['listing', "listing_{$listingId}"],
        ]);

        return [
            'cloudinary_public_id' => $result['public_id'],
        ];
    }

    public function updateListingImage(string $oldPublicId, UploadedFile $file, int $listingId): array
    {
        $this->deleteImage($oldPublicId);
        return $this->uploadListingImage($file, $listingId);
    }

    // ─── PROFILE IMAGE ────────────────────────────────────────────

    public function uploadProfileImage(UploadedFile $file, int $userId): array
    {
        $result = $this->cloudinary->uploadApi()->upload($file->getRealPath(), [
            'public_id'      => "profiles/user_{$userId}/avatar",
            'overwrite'      => true, // always overwrite — 1 photo per user
            'resource_type'  => 'image',
            'transformation' => [
                ['width' => 400, 'height' => 400, 'crop' => 'fill', 'gravity' => 'face'],
                ['quality' => 'auto:good'],
                ['fetch_format' => 'auto'],
            ],
            'tags' => ['profile', "user_{$userId}"],
        ]);

        return [
            'cloudinary_public_id' => $result['public_id'],
        ];
    }

    // ─── DELETE ───────────────────────────────────────────────────

    public function deleteImage(string $publicId): void
    {
        $this->cloudinary->uploadApi()->destroy($publicId, [
            'resource_type' => 'image',
        ]);
    }
}
