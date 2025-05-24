<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'color',
        'size',
        'material',
        'pattern',
        'weight',
        'warranty',
        'description',
        'price',
        'images',
        'is_active',
        'is_featured',
        'is_new',
        'in_stock',
        'on_sale',
    ];

    protected $casts = [
        'images' => 'array',
        'size' => 'array',
        'color' => 'array',
        'weight' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems()    
    {
        return $this->hasMany(OrderItem::class);
    }

    // Method untuk generate SKU otomatis
    public static function generateSKU($categoryName, $brandName)
    {
        // Mapping kategori ke kode SKU
        $categoryMap = [
            'kemeja batik' => 'KMJB',
            'blouse batik' => 'BLSB',
            'kaos batik' => 'KASB',
            'dress batik' => 'DRSB',
        ];

        $categoryKey = strtolower($categoryName);
        $skuPrefix = $categoryMap[$categoryKey] ?? 'PROD';

        // Cari nomor urut terakhir untuk prefix ini
        $lastProduct = self::where('sku', 'like', $skuPrefix . '%')
            ->orderBy('sku', 'desc')
            ->first();

        if ($lastProduct) {
            // Ambil nomor dari SKU terakhir
            $lastNumber = (int) substr($lastProduct->sku, strlen($skuPrefix));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Format SKU dengan padding 3 digit
        return $skuPrefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
    
}
