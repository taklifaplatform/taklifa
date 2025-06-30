<?php

namespace Modules\Support\Policies;

use App\Models\User;
use Modules\Support\Entities\Support;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupportPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_support');
    }

    public function view(User $user, Support $support): bool
    {
        return $user->can('view_support');
    }

    public function create(User $user): bool
    {
        return $user->can('create_support');
    }

    public function update(User $user, Support $support): bool
    {
        return $user->can('update_support');
    }

    public function delete(User $user, Support $support): bool
    {
        return $user->can('delete_support');
    }

    public function restore(User $user, Support $support): bool
    {
        return $user->can('restore_support');
    }

    public function forceDelete(User $user, Support $support): bool
    {
        return $user->can('force_delete_support');
    }
} 