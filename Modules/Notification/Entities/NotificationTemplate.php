<?php

namespace Modules\Notification\Entities;

use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Entities\BaseModel;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class NotificationTemplate extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, HasTranslations;

    const TYPE_NOTIFY_CUSTOMER_SHIPMENT_CONFIRMED = 'notify_customer_shipment_confirmed';

    const TYPE_COMPANY_DELETE_INVITATION = 'company_delete_invitation';

    const TYPE_COMPANY_SEND_INVITATION = 'company_send_invitation';

    const TYPE_COMPANY_UPDATE_INVITATION = 'company_update_invitation';

    const TYPE_COMPANY_MANAGER_SHIPMENT_NEW_INVITATION_NOTIFICATION = 'company_manager_shipment_new_invitation_notification';

    const TYPE_DRIVER_SHIPMENT_NEW_INVITATION_NOTIFICATION = 'driver_shipment_new_invitation_notification';

    const TYPE_SHIPMENT_INVITATION_ACCEPTED_NOTIFICATION = 'shipment_invitation_accepted_notification';

    const TYPE_SHIPMENT_INVITATION_DECLINED_NOTIFICATION = 'shipment_invitation_declined_notification';

    const TYPE_SHIPMENT_NEW_PROPOSAL_NOTIFICATION = 'shipment_new_proposal_notification';


    const TYPES = [
        self::TYPE_NOTIFY_CUSTOMER_SHIPMENT_CONFIRMED => 'Notify Recipient About Shipment Confirmed',
        self::TYPE_COMPANY_DELETE_INVITATION => 'Company Delete Invitation',
        self::TYPE_COMPANY_SEND_INVITATION => 'Company Send Invitation to new member',
        self::TYPE_COMPANY_UPDATE_INVITATION => 'Company Update Invitation',
        self::TYPE_COMPANY_MANAGER_SHIPMENT_NEW_INVITATION_NOTIFICATION => 'Company Manager Shipment New Invitation Notification',
        self::TYPE_DRIVER_SHIPMENT_NEW_INVITATION_NOTIFICATION => 'Driver Shipment New Invitation Notification',
        self::TYPE_SHIPMENT_INVITATION_ACCEPTED_NOTIFICATION => 'Shipment Invitation Accepted Notification',
        self::TYPE_SHIPMENT_INVITATION_DECLINED_NOTIFICATION => 'Shipment Invitation Declined Notification',
        self::TYPE_SHIPMENT_NEW_PROPOSAL_NOTIFICATION => 'Shipment New Proposal Notification',
    ];

    protected $fillable = [
        'type',
        'icon',
        'icon_user_avatar',
        'icon_rounded',
        'icon_background_color',
        'sms_notification',
        'sms_notification_title',
        'sms_notification_description',
        'push_notification',
        'push_notification_title',
        'push_notification_description',
        'email_notification',
        'email_notification_subject',
        'email_notification_title',
        'email_notification_description',
        'db_notification',
        'db_notification_title',
        'db_notification_description',
        'enabled',
        'order',
        'settings_title',
        'has_settings',
    ];

    protected $translatable = [
        'sms_notification_title',
        'sms_notification_description',
        'push_notification_title',
        'push_notification_description',
        'email_notification_subject',
        'email_notification_title',
        'email_notification_description',
        'db_notification_title',
        'db_notification_description',
        'settings_title',
    ];

    protected $casts = [
        'sms_notification' => 'boolean',
        'push_notification' => 'boolean',
        'email_notification' => 'boolean',
        'db_notification' => 'boolean',
        'enabled' => 'boolean',
        'icon_user_avatar' => 'boolean',
        'icon_rounded' => 'boolean',
        'has_settings' => 'boolean',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->width(600)
            ->height(600)
            ->nonQueued();
    }

    public function userSettings()
    {
        return $this->hasMany(NotificationSetting::class, 'template_id');
    }
}
