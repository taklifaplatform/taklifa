<?php

namespace Modules\Geography\Entities;

use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Geography\Entities\Location
 *
 * @property int $id
 * @property string $locationable_type
 * @property int $locationable_id
 * @property string|null $address
 * @property string|null $address_complement
 * @property string|null $postcode
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Geography\Entities\City|null $city
 * @property-read \Modules\Geography\Entities\Country|null $country
 * @property-read Model|\Eloquent $locationable
 * @property-read \Modules\Geography\Entities\State|null $state
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereAddressComplement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLocationableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLocationableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location withinPolygon($polygon)
 *
 * @mixin \Eloquent
 */
class Location extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'state_id',
        'city_id',
        'address',
        'address_complement',

        'building_name',
        'floor_number',
        'house_number',

        'notes',
        'postcode',
        'latitude',
        'longitude',
        'name',
        'phone_number',
        'is_primary',
        'locationable_id',
        'locationable_type',
    ];

    public static function validationRules(string $name = 'location'): array
    {
        return [
            $name.'.country_id' => ['nullable', 'exists:countries,id'],
            $name.'.state_id' => ['nullable', 'exists:states,id'],
            $name.'.city_id' => ['nullable', 'exists:cities,id'],
            $name.'.address' => ['nullable', 'string'],
            $name.'.address_complement' => ['nullable', 'string'],

            $name.'.building_name' => ['nullable', 'string'],
            $name.'.floor_number' => ['nullable', 'string'],
            $name.'.house_number' => ['nullable', 'string'],

            $name.'.notes' => ['nullable', 'string'],

            $name.'.postcode' => ['nullable', 'string'],

            $name.'.latitude' => ['nullable'],
            $name.'.longitude' => ['nullable'],

            $name.'.name' => ['nullable', 'string'],
            $name.'.phone_number' => ['nullable', 'string'],
            $name.'.is_primary' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function locationable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // scope within Region
    public function scopeWithinPolygon($query, $polygon)
    {
        return $query
            ->whereRaw(sprintf("MBRContains(ST_GeomFromText('Polygon((%s))'), POINT(latitude, longitude))", $polygon));
    }

    protected function location(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => [
                'latitude' => $attributes['latitude'],
                'longitude' => $attributes['longitude']
            ],
            set: fn (array $value) => [
                'latitude' => $value['latitude'],
                'longitude' => $value['longitude']
            ],
        );
    }
}
