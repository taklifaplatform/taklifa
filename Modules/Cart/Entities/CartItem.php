<?php

namespace Modules\Cart\Entities;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductVariant;
use Modules\Core\Entities\BaseModel;

class CartItem extends BaseModel
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'unit_price',
        'quantity',
        'total_price',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
