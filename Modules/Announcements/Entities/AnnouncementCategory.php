<?php

namespace Modules\Announcements\Entities;

use Modules\Core\Entities\BaseModel;
use Spatie\Translatable\HasTranslations;

class AnnouncementCategory extends BaseModel
{
    use HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'enabled',
        'order',
        'metadata_fields',
    ];

    protected $casts = [
        'metadata_fields' => 'array',
    ];

    public function parent()
    {
        return $this->belongsTo(AnnouncementCategory::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(AnnouncementCategory::class, 'parent_id');
    }

    public function enabledSubCategories()
{
        return $this->hasMany(AnnouncementCategory::class, 'parent_id')->where('enabled', true);
}

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
