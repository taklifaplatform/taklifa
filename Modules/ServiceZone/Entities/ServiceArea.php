<?php

namespace Modules\ServiceZone\Entities;

use Modules\Core\Entities\BaseModel;
use Modules\Vehicle\Entities\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\ServiceZone\Entities\ServiceArea
 *
 * @property int $id
 * @property int $service_zone_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\ServiceZone\Entities\ServiceZone $serviceZone
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Vehicle> $vehicles
 * @property-read int|null $vehicles_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceArea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceArea whereServiceZoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceArea whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ServiceArea extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'service_zone_id',
    ];

    public function serviceZone()
    {
        return $this->belongsTo(ServiceZone::class, 'service_zone_id');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'company_vehicle_service_areas', 'vehicle_id', 'service_area_id');
    }
}
