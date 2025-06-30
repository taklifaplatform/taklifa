<?php

namespace Modules\UserVerification\Entities;

use App\Models\User;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Entities\BaseModel;
use Modules\Vehicle\Entities\Vehicle;
use Modules\Geography\Entities\Country;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Geography\Entities\Traits\HasLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Modules\UserVerification\Entities\UserVerification
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $birth_date
 * @property string|null $driving_license_number
 * @property int $user_id
 * @property int|null $nationality_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Geography\Entities\Location|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geography\Entities\Location> $locations
 * @property-read int|null $locations_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read Country|null $nationality
 * @property-read User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereDrivingLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereNationalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserVerification extends BaseModel implements HasMedia
{
    use HasFactory, HasLocation, InteractsWithMedia;

    /**
     * verification_status:
     * - pending
     * - in_review
     * - verified
     * - rejected
     */
    const VERIFICATION_STATUS_PENDING = 'pending';
    const VERIFICATION_STATUS_IN_REVIEW = 'in_review';
    const VERIFICATION_STATUS_VERIFIED = 'verified';
    const VERIFICATION_STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id',
        'name',
        'birth_date',
        'driving_license_number',
        'nationality_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 600, 600)
            ->nonQueued();
    }

    // belong to user verified by
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function verify()
    {
        $this->is_verified = true;
        $this->verified_at = now();
        $this->verified_by = auth()->id();
        $this->verification_status = self::VERIFICATION_STATUS_VERIFIED;
        $this->save();
    }

    public function reject()
    {
        $this->is_verified = false;
        $this->verified_at = null;
        $this->verified_by = null;
        $this->verification_status = self::VERIFICATION_STATUS_REJECTED;
        $this->save();
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'ownable_id', 'user_id');
    }
}
