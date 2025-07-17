<?php

namespace Modules\Company\Entities;

use App\Models\User;
use Spatie\Image\Enums\Fit;
use Modules\Cart\Entities\Cart;
use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Entities\BaseModel;
use Modules\Product\Entities\Product;
use Modules\Services\Entities\Service;
use Modules\Geography\Entities\Location;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Rating\Entities\Traits\HasRating;
use Modules\Support\Entities\Traits\HasReport;
use Modules\Geography\Entities\Traits\HasLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Modules\Company\Entities\Company
 *
 * @property int $id
 * @property string $name
 * @property int|null $owner_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $drivers
 * @property-read int|null $drivers_count
 * @property-read \Modules\Geography\Entities\Location|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geography\Entities\Location> $locations
 * @property-read int|null $locations_count
 * @property-read int|null $manager_invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $managers
 * @property-read int|null $managers_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Rating\Entities\Rating> $ratings
 * @property-read int|null $ratings_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Company extends BaseModel implements HasMedia
{
    use HasFactory,
        HasLocation,
        HasRating,
        HasReport,
        InteractsWithMedia;

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
        'name',
        'about',
        'owner_id',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 600, 600)
            ->nonQueued();
    }


    public function scopeActive($query)
    {
        return $query->where('is_verified', true);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->hasMany(CompanyMember::class, 'company_id');
    }

    public function managers()
    {
        return $this->belongsToMany(User::class, 'company_members', 'company_id', 'user_id')
            ->wherePivot('role', 'company_manager');
    }
    public function invitations()
    {
        return $this->hasMany(CompanyInvitation::class, 'company_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'company_id');
    }

    public function branches()
    {
        return $this->hasMany(CompanyBranch::class, 'company_id');
    }

    public function isCompanyMember(User $user): bool
    {
        return
            $this->members()->where('user_id', $user->id)->exists() ||
            $this->owner_id == $user->id;
    }

    /**
     * permission:
     *  - update_company
     *  - delete_company
     *  - manage_drivers
     *  - manage_driver_invitations
     *  - manage_managers
     *  - manage_manager_invitations
     */
    public function can(User $user, $permission): bool
    {
        if (! $user->hasRole('company_owner') && ! $user->hasRole('company_manager')) {
            return false;
        }

        return !!$this->members()->where('user_id', $user->id)->first() || $this->owner_id == $user->id;
    }

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

    public function products()
    {
        return $this->hasMany(Product::class, 'company_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
