<?php

namespace Modules\Vehicle\Entities;

use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Vehicle\Entities\VehicleInformation
 *
 * @property int $id
 * @property int $vehicle_id
 * @property string|null $body_type
 * @property string|null $steering_wheel
 * @property int|null $top_speed
 * @property int|null $doors_count
 * @property int|null $seats_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Vehicle\Entities\Vehicle $vehicle
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereBodyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereDoorsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereSeatsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereSteeringWheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereTopSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleInformation whereVehicleId($value)
 *
 * @mixin \Eloquent
 */
class VehicleInformation extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'body_type',
        'steering_wheel',
        'top_speed',
        'doors_count',
        'seats_count',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
