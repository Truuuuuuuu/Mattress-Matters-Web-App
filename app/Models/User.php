<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\CloudinaryService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'theme',
        'profile_photo_public_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['profile_photo_url'];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function profilePhotoUrl(): Attribute
    {
        return Attribute::get(function () {
            if (!$this->profile_photo_public_id) {
                return null;
            }
            return app(CloudinaryService::class)->getSecureUrl($this->profile_photo_public_id);
        });
    }

    public function host(): HasOne
    {
        return $this->hasOne(Host::class);
    }

    public function tenant(): HasOne
    {
        return $this->hasOne(Tenant::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function tenantProfile(): HasOne
    {
        return $this->hasOne(Tenant::class);
    }

    public function hostProfile(): HasOne
    {
        return $this->hasOne(Host::class);
    }
    public function getProfile(): Tenant|Host|null
    {
        if ($this->hasRole('tenant')) {
            return $this->tenantProfile;
        }

        return $this->hostProfile()->withCount('listings')->first();
    }

    /*get firstname*/
    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->name)[0];
    }
}
