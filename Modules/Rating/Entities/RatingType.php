<?php

namespace Modules\Rating\Entities;

use Modules\Core\Entities\BaseModel;

/**
 * Modules\Rating\Entities\RatingType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Rating\Entities\Rating> $ratings
 * @property-read int|null $ratings_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RatingType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class RatingType extends BaseModel
{
    protected $fillable = [
        'name',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
