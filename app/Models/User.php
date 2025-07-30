<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Modules\Auth\Entities\Role;
use Modules\Cart\Entities\Cart;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Modules\User\Entities\Profile;
use Modules\Company\Entities\Company;
use Filament\Models\Contracts\HasName;
use Modules\Core\Entities\PhoneNumber;
use Modules\Services\Entities\Service;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Modules\Geography\Entities\Location;
use Illuminate\Notifications\Notification;
use Filament\Models\Contracts\FilamentUser;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Rating\Entities\Traits\HasRating;
use Modules\Support\Entities\Traits\HasReport;
use Modules\Company\Entities\Traits\HasCompany;
use Modules\Geography\Entities\Traits\HasLocation;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Entities\Traits\HasEmailVerification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Notification\Entities\Traits\HasNotifications;
use Modules\Auth\Entities\Traits\HasPhoneNumberVerification;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $avatar_url
 * @property string $username
 * @property string $name
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon|null $phone_number_verified_at
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string $latest_activity
 * @property string $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $active_role_id
 * @property int|null $active_company_id
 * @property-read Company|null $activeCompany
 * @property-read Role|null $activeRole
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Company> $companies
 * @property-read int|null $companies_count
 * @property-read \Modules\Geography\Entities\Location|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Geography\Entities\Location> $locations
 * @property-read int|null $locations_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, PhoneNumber> $phoneNumbers
 * @property-read int|null $phone_numbers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Rating\Entities\Rating> $ratings
 * @property-read int|null $ratings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLatestActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumberVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements FilamentUser, HasAvatar, HasMedia, HasName
{
    use HasApiTokens;
    use HasCompany;
    use HasEmailVerification;
    use HasEmailVerification;
    use HasFactory;
    use HasLocation;
    use HasNotifications, Notifiable;
    use HasPanelShield;
    use HasPhoneNumberVerification;
    use HasRating;
    use HasReport;
    use HasRoles;
    use HasUuids;
    use InteractsWithMedia;

    const ROLE_COMPANY_ADMIN = 'company_admin';

    const ROLE_COMPANY_OWNER = 'company_owner';

    const ROLE_COMPANY_MANAGER = 'company_manager';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'phone_number',
        'email',
        'password',
        'active_role_id',
        'active_company_id',
        'about',
        'urgency_service_provider',
        'urgency_service_radius',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function getFilamentName(): string
    {
        if (! $this->name) {
            return $this->username;
        }

        return $this->name;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 600, 600)
            ->nonQueued();
    }

    /**
     * Route notifications for the Vonage channel.
     */
    public function routeNotificationForVonage(Notification $notification): string
    {
        return $this->phone_number;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function phoneNumbers()
    {
        return $this->morphMany(PhoneNumber::class, 'phoneable');
    }

    public function canAccessFilament(): bool
    {
        return $this->id === 2 || $this->hasRole('admin') || $this->hasRole('super_admin');
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        if ($panel->getId() === 'company') {
            return $this->isCompanyOwner();
        }

        return $this->id === 2 || $this->hasRole('admin') || $this->hasRole('super_admin');
    }

    public function activeRole()
    {
        return $this->belongsTo(Role::class, 'active_role_id');
    }

    public function getActiveRole()
    {
        if (! $this->active_role_id) {
            $firstRole = $this->roles()->first();
            if (! $firstRole) {
                return null;
            }
            $this->active_role_id = $firstRole->id;
            $this->save();
        }

        return $this->activeRole;
    }

    public function setActiveRole(string $roleName)
    {
        if (! $this->hasRole($roleName)) {
            abort(404);
        }
        $role = Role::where('name', $roleName)->first();
        if (! $role) {
            abort(500, 'Role not found');
        }
        $this->active_role_id = $role->id;
        $this->save();
    }

    public function getActiveCompany()
    {
        if (! $this->active_company_id) {
            $firstCompany = $this->companies()->first();
            if (! $firstCompany) {
                return null;
            }
            $this->active_company_id = $firstCompany->id;
            $this->save();
        }

        return $this->activeCompany();
    }

    public function activeCompany()
    {
        return $this->belongsTo(Company::class, 'active_company_id');
    }

    /**
     * Alias for activeCompany for convenience
     */
    public function company()
    {
        return $this->getActiveCompany();
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function routeNotificationForDeewan($notification)
    {
        return [
            $this->phone_number,
        ];
    }

    /**
     * Get the company owned by this user
     */
    public function ownedCompany()
    {
        return $this->hasOne(\Modules\Company\Entities\Company::class, 'owner_id');
    }

    /**
     * Check if the user is a company owner
     */
    public function isCompanyOwner(): bool
    {
        return $this->hasRole(self::ROLE_COMPANY_OWNER);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
