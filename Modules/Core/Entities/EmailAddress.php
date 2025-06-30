<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Core\Entities\EmailAddress
 *
 * @property int $id
 * @property string $email
 * @property string $type
 * @property string $emailable_type
 * @property int $emailable_id
 * @property int $is_primary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Modules\Core\Database\factories\EmailAddressFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress whereEmailableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress whereEmailableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailAddress whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class EmailAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_primary',
        'type',

    ];

    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\EmailAddressFactory::new();
    }
}
