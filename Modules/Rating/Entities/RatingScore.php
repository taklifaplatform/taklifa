<?php

namespace Modules\Rating\Entities;

use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Rating\Entities\RatingScore
 *
 * @property int $id
 * @property int $rating_id
 * @property int $rating_type_id
 * @property float $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Rating\Entities\Rating $rating
 * @property-read \Modules\Rating\Entities\RatingType $type
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore query()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore whereRatingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore whereRatingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingScore whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class RatingScore extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'score',
        'rating_type_id',
    ];

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

    public function type()
    {
        return $this->belongsTo(RatingType::class, 'rating_type_id');
    }
}
