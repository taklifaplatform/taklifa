<?php

namespace Modules\Vehicle\Entities;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Entities\BaseModel;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Modules\Vehicle\Entities\VehicleModel
 *
 * @property int $id
 * @property string|null $name
 * @property int $vehicle_make_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereVehicleMakeId($value)
 *
 * @mixin \Eloquent
 */
class VehicleModel extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    protected $fillable = [
        'name',
        'map_icon_width',
        'map_icon_height',
        'order',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public $translatable = [
        'name',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->keepOriginalImageFormat()
            ->fit(Fit::Contain, 600, 600)
            ->nonQueued();
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

}
