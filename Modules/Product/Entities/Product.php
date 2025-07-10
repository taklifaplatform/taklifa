<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Company\Entities\Company;
use Modules\Core\Entities\BaseModel;
use Modules\Cart\Entities\CartItem;

class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'category_id',
        'is_available',
        'created_with_ai',
    ];

    protected $attributes = [
        'is_available' => true,
        'created_with_ai' => false,
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function variant()
    {
        return $this->hasOne(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
