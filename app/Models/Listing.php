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
        return $query
            ->when($filters['search'] ?? false, function ($query, $search) {
                $terms = explode(' ', $search);
                $isFirst = true;

                foreach ($terms as $term) {
                    if ($isFirst) {
                        $query->where('title', 'like', '%' . $term . '%');
                        $isFirst = false;
                    } else {
                        $query->orWhere('title', 'like', '%' . $term . '%');
                    }
                }
            })
            ->when($filters['min_price'] ?? false, function ($query, $min) {
                $query->where('rent_cost', '>=', $min);
            })
            ->when($filters['max_price'] ?? false, function ($query, $max) {
                $query->where('rent_cost', '<=', $max);
            })
            ->when($filters['amenities'] ?? false, function ($query, $amenities) {
                $query->whereHas('amenities', function ($q) use ($amenities) {
                    $q->whereIn('amenities.id', $amenities);
                });
            })
            ->when($filters['rules'] ?? false, function ($query, $rules) {
                $query->whereHas('rules', function ($q) use ($rules) {
                    $q->whereIn('rules.id', $rules);
                });
            });
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
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

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
