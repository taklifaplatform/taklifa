<?php

namespace Modules\Notification\Policies;

use App\Models\User;
use Modules\Notification\Entities\NotificationSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationSettingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_notification_setting');
    }

    public function view(User $user, NotificationSetting $notificationSetting): bool
    {
        return $user->can('view_notification_setting');
    }

    public function create(User $user): bool
    {
        return $user->can('create_notification_setting');
    }

    public function update(User $user, NotificationSetting $notificationSetting): bool
    {
        return $user->can('update_notification_setting');
    }

    public function delete(User $user, NotificationSetting $notificationSetting): bool
    {
        return $user->can('delete_notification_setting');
    }

    public function restore(User $user, NotificationSetting $notificationSetting): bool
    {
        return $user->can('restore_notification_setting');
    }

    public function forceDelete(User $user, NotificationSetting $notificationSetting): bool
    {
        return $user->can('force_delete_notification_setting');
    }
} 