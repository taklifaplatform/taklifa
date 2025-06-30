<?php

namespace Modules\Vehicle\Entities;

use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Vehicle\Entities\VehicleFuelInformation
 *
 * @property int $id
 * @property int $vehicle_id
 * @property string|null $fuel_type
 * @property float|null $fuel_capacity
 * @property float|null $liter_per_km_in_city
 * @property float|null $liter_per_km_in_highway
 * @property float|null $liter_per_km_mixed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Vehicle\Entities\Vehicle $vehicle
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereFuelCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereFuelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereLiterPerKmInCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereLiterPerKmInHighway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereLiterPerKmMixed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleFuelInformation whereVehicleId($value)
 *
 * @mixin \Eloquent
 */
class VehicleFuelInformation extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'fuel_type',
        'fuel_capacity',
        'liter_per_km_in_city',
        'liter_per_km_in_highway',
        'liter_per_km_mixed',
    ];

    protected $table = 'vehicle_fuel_information';

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
