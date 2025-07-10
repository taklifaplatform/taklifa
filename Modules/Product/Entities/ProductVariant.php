<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Entities\BaseModel;
use Modules\Product\Entities\Product;
use Modules\Cart\Entities\CartItem;

class ProductVariant extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'price_currency',
        'type',
        'type_unit',
        'type_value',
        'stock',
        'product_id',
    ];

    protected $attributes = [
        'price_currency' => 'SAR',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
