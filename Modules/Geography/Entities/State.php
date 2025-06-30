<?php

namespace Modules\Geography\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Modules\Geography\Entities\State
 *
 * @property int $id
 * @property int|null $country_id
 * @property string $name
 * @property string $code
 * @property string|null $postal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Geography\Entities\Country|null $country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State wherePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class State extends Model
{
    use HasTranslations;
    protected $fillable = [
        'name',
        'title',
        'code',
        'postal',
    ];

    public $translatable = [
        'title'
    ];

    /**
     * Get the country that owns the CountryDialling
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
