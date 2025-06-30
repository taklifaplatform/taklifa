<?php

namespace Modules\Support\Entities;

use Modules\Core\Entities\BaseModel;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportReason extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
    ];

    protected $translatable = [
        'name',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, 'reason_id');
    }
}
