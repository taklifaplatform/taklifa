<?php

namespace Modules\Company\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Illuminate\Notifications\Notifiable;
use Modules\Notification\Jobs\SendNotificationJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Company\Entities\CompanyInvitation
 *
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property string|null $email
 * @property int $company_id
 * @property int|null $sender_id
 * @property string $invitation_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Company\Entities\Company $company
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read User|null $sender
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation whereInvitationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInvitation whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CompanyInvitation extends BaseModel
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'message',
        'role',
        'company_id',
        'sender_id',
        'invitation_code',
        'is_rejected',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function getUrl()
    {
        return "https://sawaeed.app/auth/invitations/{$this->invitation_code}";
    }

    public function sendInvitation()
    {
        $invitedUser = User::where('phone_number', $this->phone_number)->first();
        if (! $invitedUser) {
            $invitedUser = User::create([
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'name' => $this->name,
                'password' => bcrypt($this->phone_number . '_' . $this->name),
                'username' => $this->phone_number . '_' . $this->name,
            ]);
        } else {
            if (! $invitedUser->name) {
                $invitedUser->name = $this->name;
            }
            $invitedUser->save();
        }

        SendNotificationJob::dispatch(
            type: \Modules\Notification\Entities\NotificationTemplate::TYPE_COMPANY_SEND_INVITATION,
            recipient: $invitedUser,
            sender: $this->sender,
            model: $this,
        );
    }
}
