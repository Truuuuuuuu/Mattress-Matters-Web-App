<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Amenity extends Model
{
    //Uses belongsToMany relationship since this and listings uses pivot table(amenity_listing)
    public function listings(): BelongsToMany
    {
        return $this->belongsToMany(Listing::class);
    }
}
