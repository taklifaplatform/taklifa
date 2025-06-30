<?php

namespace Modules\ServiceZone\Entities;

use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\ServiceZone\Entities\ServiceZone
 *
 * @property int $id
 * @property string $ownable_type
 * @property int $ownable_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $ownable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\ServiceZone\Entities\ServiceArea> $serviceArea
 * @property-read int|null $service_area_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone whereOwnableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone whereOwnableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceZone whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ServiceZone extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ownable_id',
        'ownable_type',
    ];

    public function serviceArea()
    {
        return $this->hasMany(ServiceArea::class, 'service_zone_id');
    }

    public function ownable()
    {
        return $this->morphTo('ownable');
    }
}
