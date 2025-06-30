<?php

namespace Modules\Shipment\Entities;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Entities\BaseModel;
use Modules\Shipment\Entities\Shipment;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ShipmentItem extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'shipment_id',
        'notes',
        'dim_unit',
        'dim_width',
        'dim_height',
        'dim_length',
        'cap_unit',
        'cap_weight',
        'content',
        'content_value',
    ];

    protected $casts = [
        'content_value' => 'array',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 600, 600)
            ->nonQueued();
    }
}
