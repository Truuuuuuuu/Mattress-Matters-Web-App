<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory;


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
               $q->where('name', 'like', '%'.$search.'%')
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

}
