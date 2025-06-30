<?php

namespace Modules\Geography\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Modules\Geography\Entities\Currency
 *
 * @property int $id
 * @property string $name
 * @property string $iso_code
 * @property string $iso_number
 * @property array|null $units
 * @property array|null $coins
 * @property array|null $banknotes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geography\Entities\Country> $countries
 * @property-read int|null $countries_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereBanknotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCoins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIsoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Currency extends Model
{
    use HasTranslations;
    protected $fillable = [
        'title',
        'name',
        'iso_code',
        'iso_number',
        'units',
        'coins',
        'banknotes',
        'sort',
    ];

    protected $casts = [
        'units' => 'array',
        'coins' => 'array',
        'banknotes' => 'array',
        'title' => 'array',
    ];

    public $translatable = [
        'title',
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'currency_countries');
    }
}
