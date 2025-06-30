<?php

namespace Modules\WorkingHours\Policies;

use App\Models\User;
use Modules\WorkingHours\Entities\WorkingHour;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkingHourPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_working_hour');
    }

    public function view(User $user, WorkingHour $workingHour): bool
    {
        return $user->can('view_working_hour');
    }

    public function create(User $user): bool
    {
        return $user->can('create_working_hour');
    }

    public function update(User $user, WorkingHour $workingHour): bool
    {
        return $user->can('update_working_hour');
    }

    public function delete(User $user, WorkingHour $workingHour): bool
    {
        return $user->can('delete_working_hour');
    }

    public function restore(User $user, WorkingHour $workingHour): bool
    {
        return $user->can('restore_working_hour');
    }

    public function forceDelete(User $user, WorkingHour $workingHour): bool
    {
        return $user->can('force_delete_working_hour');
    }
} 