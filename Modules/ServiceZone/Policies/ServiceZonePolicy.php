<?php

namespace Modules\ServiceZone\Policies;

use App\Models\User;
use Modules\ServiceZone\Entities\ServiceZone;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceZonePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_service_zone');
    }

    public function view(User $user, ServiceZone $serviceZone): bool
    {
        return $user->can('view_service_zone');
    }

    public function create(User $user): bool
    {
        return $user->can('create_service_zone');
    }

    public function update(User $user, ServiceZone $serviceZone): bool
    {
        return $user->can('update_service_zone');
    }

    public function delete(User $user, ServiceZone $serviceZone): bool
    {
        return $user->can('delete_service_zone');
    }

    public function restore(User $user, ServiceZone $serviceZone): bool
    {
        return $user->can('restore_service_zone');
    }

    public function forceDelete(User $user, ServiceZone $serviceZone): bool
    {
        return $user->can('force_delete_service_zone');
    }
} 