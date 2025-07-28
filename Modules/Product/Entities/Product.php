<?php

namespace Modules\Product\Entities;

use Modules\Company\Entities\Company;
use Modules\Core\Entities\BaseModel;
use Modules\Cart\Entities\CartItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'category_id',
        'batch_product_id',
        'is_available',
        'is_published',
        'created_with_ai',
        'extracted_tags',
        'extracted_colors',
        'extracted_details',
    ];

    protected $attributes = [
        'is_available' => true,
        'created_with_ai' => false,
    ];

    protected $casts = [
        'extracted_tags' => 'array',
        'extracted_colors' => 'array',
        'extracted_details' => 'array',
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

    public function batchProduct()
    {
        return $this->belongsTo(BatchProduct::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function publish()
    {
        $this->is_published = true;
        $this->is_available = true;
        $this->save();
    }
}
