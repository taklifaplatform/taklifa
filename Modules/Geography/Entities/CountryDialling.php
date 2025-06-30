<?php

namespace Modules\Geography\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Geography\Entities\CountryDialling
 *
 * @property int $id
 * @property int|null $country_id
 * @property array|null $calling_code
 * @property string|null $international_prefix
 * @property array|null $national_destination_code_lengths
 * @property array|null $national_number_lengths
 * @property string|null $national_prefix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Geography\Entities\Country|null $country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling query()
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereCallingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereInternationalPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereNationalDestinationCodeLengths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereNationalNumberLengths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereNationalPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CountryDialling whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CountryDialling extends Model
{
    protected $fillable = [
        'calling_code',
        'international_prefix',
        'national_destination_code_lengths',
        'national_number_lengths',
        'national_prefix',
        'prefix',
        'dial_code',
        'mask_char',
        'mask',
        'iso',
        'code',
    ];

    protected $casts = [
        'calling_code' => 'array',
        'national_destination_code_lengths' => 'array',
        'national_number_lengths' => 'array',
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
