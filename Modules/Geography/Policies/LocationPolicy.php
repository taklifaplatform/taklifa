<?php

namespace Modules\Geography\Policies;

use App\Models\User;
use Modules\Geography\Entities\Location;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_location');
    }

    public function view(User $user, Location $location): bool
    {
        return $user->can('view_location');
    }

    public function create(User $user): bool
    {
        return $user->can('create_location');
    }

    public function update(User $user, Location $location): bool
    {
        return $user->can('update_location');
    }

    public function delete(User $user, Location $location): bool
    {
        return $user->can('delete_location');
    }

    public function restore(User $user, Location $location): bool
    {
        return $user->can('restore_location');
    }

    public function forceDelete(User $user, Location $location): bool
    {
        return $user->can('force_delete_location');
    }
} 