<?php

namespace Modules\Support\Entities;

use Modules\Core\Entities\BaseModel;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportCategory extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
    ];

    protected $translatable = [
        'name',
    ];

    public function supports()
    {
        return $this->hasMany(Support::class, 'category_id');
    }
}
