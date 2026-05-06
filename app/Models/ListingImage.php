<?php

namespace App\Models;

use App\Services\CloudinaryService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    protected $fillable = [
        'is_cover',
        'listing_id',
        'cloudinary_public_id',
        'sort_order',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    protected $appends = ['url'];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    // Derives URL from public_id — never stored in DB
    protected function url(): Attribute
    {
        return Attribute::get(
            fn () => $this->cloudinary_public_id
                ? app(CloudinaryService::class)->getSecureUrl($this->cloudinary_public_id)
                : null
        );
    }

}
