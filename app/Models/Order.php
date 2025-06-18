<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'no_resi',
        'notes',
       
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function Address()
    {
        return $this->hasOne(Address::class);
    }
}
