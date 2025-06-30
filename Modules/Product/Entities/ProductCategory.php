<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Company\Entities\Company;
use Modules\Core\Entities\BaseModel;

class ProductCategory extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order',
        'parent_id',
        'company_id',
    ];

    protected $attributes = [
        'order' => 0,
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
