<?php

namespace Modules\Vehicle\Entities;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Entities\BaseModel;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\ServiceZone\Entities\ServiceArea;
use Modules\ServiceZone\Entities\ServiceZone;
use Modules\Support\Entities\Traits\HasReport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Modules\Vehicle\Entities\Vehicle
 *
 * @property int $id
 * @property string $ownable_type
 * @property int $ownable_id
 * @property int|null $model_id
 * @property int|null $vehicle_make_id
 * @property int|null $vehicle_icon_id
 * @property string|null $internal_id
 * @property string|null $color
 * @property string|null $plate_number
 * @property string|null $vin_number
 * @property string|null $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Vehicle\Entities\VehicleCapacityDimensions|null $capacityDimensions
 * @property-read \Modules\Vehicle\Entities\VehicleCapacityWeight|null $capacityWeight
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Company> $drivers
 * @property-read int|null $drivers_count
 * @property-read \Modules\Vehicle\Entities\VehicleFuelInformation|null $fuelInformation
 * @property-read \Modules\Vehicle\Entities\VehicleInformation|null $information
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read Model|\Eloquent $ownable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ServiceArea> $serviceAreas
 * @property-read int|null $service_areas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ServiceZone> $serviceZones
 * @property-read int|null $service_zones_count
 * @property-read \Modules\Vehicle\Entities\VehicleModel|null $model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereInternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOwnableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOwnableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePlateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVINNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVehicleIconId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVehicleMakeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVehicleModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereYear($value)
 *
 * @mixin \Eloquent
 */
class Vehicle extends BaseModel implements HasMedia
{
    use HasFactory, HasReport, InteractsWithMedia;

    protected $fillable = [
        'ownable_id',
        'ownable_type',
        'name',
        'model_id',
        'vehicle_icon_id',
        'internal_id',
        'color',
        'plate_number',
        'vin_number',
        'year',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 600, 600)
            ->nonQueued();
    }

    public function ownable()
    {
        return $this->morphTo('ownable');
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    public function information()
    {
        return $this->hasOne(VehicleInformation::class, 'vehicle_id');
    }

    public function fuelInformation()
    {
        return $this->hasOne(VehicleFuelInformation::class, 'vehicle_id');
    }

    public function capacityDimensions()
    {
        return $this->hasOne(VehicleCapacityDimensions::class, 'vehicle_id');
    }

    public function capacityWeight()
    {
        return $this->hasOne(VehicleCapacityWeight::class, 'vehicle_id');
    }

    public function drivers()
    {
        return $this->belongsToMany(Company::class, 'company_vehicle_drivers', 'vehicle_id', 'driver_id');
    }

    public function serviceZones()
    {
        return $this->belongsToMany(ServiceZone::class, 'company_vehicle_service_zones', 'vehicle_id', 'service_zone_id');
    }

    public function serviceAreas()
    {
        return $this->belongsToMany(ServiceArea::class, 'company_vehicle_service_areas', 'vehicle_id', 'service_area_id');
    }
}
