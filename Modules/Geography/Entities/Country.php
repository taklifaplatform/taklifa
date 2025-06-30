<?php

namespace Modules\Geography\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Modules\Geography\Entities\Country
 *
 * @property int $id
 * @property array $name
 * @property string $code
 * @property string|null $wikidata_id
 * @property array|null $languages
 * @property string $flag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geography\Entities\City> $cities
 * @property-read int|null $cities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geography\Entities\Currency> $currencies
 * @property-read int|null $currencies_count
 * @property-read \Modules\Geography\Entities\CountryDialling|null $dialling
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geography\Entities\State> $states
 * @property-read int|null $states_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geography\Entities\Tax> $taxes
 * @property-read int|null $taxes_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereWikidataId($value)
 *
 * @mixin \Eloquent
 */
class Country extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'code',
        'wikidata_id',
        'flag',
        'languages',
        'sort',
    ];

    protected $casts = [
        'languages' => 'array',
        'name' => 'array',
    ];

    public $translatable = [
        'name',
    ];

    /**
     * Get the CountryDialling
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dialling()
    {
        return $this->hasOne(CountryDialling::class);
    }

    /**
     * Get the states for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }

    /**
     * Get the cities for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the taxes for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    /**
     * Get the currencies for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'currency_countries');
    }

    /**
     * Get the country's flag.
     *
     * @return string
     */
    public function getFlagAttribute($value)
    {
        return $value ? $value : '🏳️';
    }
}
