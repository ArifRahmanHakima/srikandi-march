<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'order_id',
        'full_name',
        'phone',
        'street_address',
        'province',
        'city',
        'subdistrict',
        'zip_code',
        
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
