<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'host_id',
        'title',
        'address',
        'description',
        'slot',
        'rent_cost',
        'water_supply_cost',
        'electricity_cost',
        'status',

    ];

    public function host(): BelongsTo
    {
        return $this->belongsTo(Host::class);
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    /*filter search*/
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search){
           $query->where(function ($q) use ($search){
               $q->where('title', 'like', '%'.$search.'%')
                   ->orWhere('description', 'like', '%'.$search.'%');
           });
        });

        $query->when($filters['min_price'] ?? false, fn ($q, $minPrice) =>
            $q->where('price', '>=', $minPrice)
        );

        $query->when($filters['max_price'] ?? false, fn ($q, $maxPrice) =>
            $q->where('price', '<=', $maxPrice)
        );
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsTomany(Amenity::class);
    }

    public function rules(): BelongsToMany
    {
        return $this->belongsToMany(Rule::class);
    }

    public function listingImages(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }
}
