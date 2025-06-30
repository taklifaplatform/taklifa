<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Entities\BaseModel;
use Modules\Product\Entities\Product;

class ProductVariant extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'price',
        'price_currency',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
