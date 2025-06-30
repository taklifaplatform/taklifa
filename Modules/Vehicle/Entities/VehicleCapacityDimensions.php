<?php

namespace Modules\Vehicle\Entities;

use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Vehicle\Entities\VehicleCapacityDimensions
 *
 * @property int $id
 * @property int $vehicle_id
 * @property string|null $length
 * @property string|null $width
 * @property string|null $height
 * @property string $unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Vehicle\Entities\Vehicle $vehicle
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions whereVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCapacityDimensions whereWidth($value)
 *
 * @mixin \Eloquent
 */
class VehicleCapacityDimensions extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'length',
        'width',
        'height',
        'unit',
    ];

    protected $table = 'vehicle_capacity_dimensions';

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
