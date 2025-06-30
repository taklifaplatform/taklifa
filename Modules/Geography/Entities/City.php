<?php

namespace Modules\Geography\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Modules\Geography\Entities\City
 *
 * @property int $id
 * @property int|null $country_id
 * @property array $name
 * @property string|null $timezone
 * @property string|null $wikidata_id
 * @property string $ref
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Geography\Entities\Country|null $country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereWikidataId($value)
 *
 * @mixin \Eloquent
 */
class City extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'timezone',
        'wikidata_id',
        'ref',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public $translatable = [
        'name',
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
