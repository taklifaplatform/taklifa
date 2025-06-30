<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Core\Entities\PhoneNumber
 *
 * @property int $id
 * @property string $number
 * @property string $type
 * @property string $phoneable_type
 * @property int $phoneable_id
 * @property int $is_primary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Modules\Core\Database\factories\PhoneNumberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber wherePhoneableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber wherePhoneableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'type',
        'is_primary',
    ];

    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\PhoneNumberFactory::new();
    }
}
