<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'bio',
        'profile_photo_path',
        'country',
        'city',
        'state',
        'code_post',
        'street_address',
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function getCityStateAttribute()
    {
        $parts = [];
        if ($this->city) $parts[] = $this->city;
        if ($this->state) $parts[] = $this->state;
        
        return count($parts) > 0 ? implode(', ', $parts) : '';
    }
     public function canAccessPanel(Panel $panel): bool
    {
        return $this->email == 'srikandi@gmail.com';
        return $this->email == 'admin@gmail.com';

    }
}
