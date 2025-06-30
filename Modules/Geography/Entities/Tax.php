<?php

namespace Modules\Geography\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Geography\Entities\Tax
 *
 * @property int $id
 * @property string $name
 * @property array|null $rates
 * @property string|null $cca3
 * @property string|null $cca2
 * @property string|null $zone
 * @property string|null $vat_id
 * @property string|null $tax_type
 * @property string|null $generic_label
 * @property int|null $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Geography\Entities\Country|null $country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereCca2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereCca3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereGenericLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereRates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereTaxType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereVatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereZone($value)
 *
 * @mixin \Eloquent
 */
class Tax extends Model
{
    protected $fillable = [
        'name',
        'rates',
        'cca3',
        'cca2',
        'zone',
        'vat_id',
        'tax_type',
        'generic_label',
        'country_id',
    ];

    protected $casts = [
        'rates' => 'array',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
