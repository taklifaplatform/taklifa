<?php

namespace Modules\Support\Entities;

use Modules\Core\Entities\BaseModel;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'content',
        'order',
    ];

    public $translatable = [
        'title',
        'content',
    ];
}
