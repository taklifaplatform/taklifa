<?php

namespace Modules\Vehicle\Entities;

use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Vehicle\Entities\VehicleCapacityWeight
 *
 * @property int $id
 * @property int $vehicle_id
 * @property string|null $value
 * @property string $unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Vehicle\Entities\Vehicle $vehicle
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityWeight whereVehicleId($value)
 *
 * @mixin \Eloquent
 */
class VehicleCapacityWeight extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'value',
        'unit',
    ];

    protected $table = 'vehicle_capacity_weights';

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
