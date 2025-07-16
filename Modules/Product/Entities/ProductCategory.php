<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Entities\BaseModel;

class ProductCategory extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order',
        'parent_id',
    ];

    protected $attributes = [
        'order' => 0,
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public $translatable = [
        'name',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')->orderBy('order');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
}
