<?php

namespace Modules\Notification\Entities\Traits;

use Modules\Notification\Entities\NotificationDriver;
use Modules\Notification\Entities\NotificationSetting;

trait HasNotifications
{
    /**
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'notifications.' . $this->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notificationDrivers()
    {
        return $this->morphMany(NotificationDriver::class, 'notifable');
    }

    public function routeNotificationForExpo($notification)
    {
        return $this->notificationDrivers()->where('driver', 'expo')->pluck('token')->toArray();
    }

    public function notificationSettings()
    {
        return $this->hasMany(NotificationSetting::class);
    }
}
