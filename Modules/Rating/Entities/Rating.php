<?php

namespace Modules\Rating\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Rating\Entities\Rating
 *
 * @property int $id
 * @property string $rateable_type
 * @property int $rateable_id
 * @property float $score
 * @property int|null $user_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $rateable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Rating\Entities\RatingScore> $scores
 * @property-read int|null $scores_count
 * @property-read User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereRateableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereRateableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Rating extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function rateable()
    {
        return $this->morphTo('rateable');
    }

    public function scores()
    {
        return $this->hasMany(RatingScore::class);
    }
}
