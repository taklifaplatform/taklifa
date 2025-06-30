<?php

namespace Modules\Services\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class Service extends BaseModel
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'sub_category_id',
        'user_id',
        'metadata',
        'city',
    ];

    protected $casts = [
        'metadata' => 'array',
        'price' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'sub_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
