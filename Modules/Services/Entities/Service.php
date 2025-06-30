<?php

namespace Modules\Services\Entities;

use App\Models\User;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Entities\BaseModel;
use Modules\Company\Entities\Company;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Geography\Entities\Traits\HasPrice;
use Modules\Geography\Entities\Traits\HasLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Service extends BaseModel implements HasMedia
{
    use HasFactory, HasLocation, HasPrice, InteractsWithMedia;

    protected $fillable = [
        'company_id',
        'driver_id',
        'title',
        'description',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 600, 600)
            ->nonQueued();
    }


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
