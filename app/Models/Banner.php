<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'is_active',
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
