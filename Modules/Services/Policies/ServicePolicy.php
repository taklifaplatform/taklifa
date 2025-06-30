<?php

namespace Modules\Services\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Services\Entities\Service;

class ServicePolicy
{
    use HandlesAuthorization;

     /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_Service');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Service $Service): bool
    {
        return $user->can('view_Service');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_Service');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $Service): bool
    {
        return $user->can('update_Service');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $Service): bool
    {
        return $user->can('delete_Service');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_Service');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Service $Service): bool
    {
        return $user->can('force_delete_Service');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Service $Service): bool
    {
        return $user->can('restore_Service');
    }

     /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_Service');
    }

      /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Service $Service): bool
    {
        return $user->can('replicate_Service');
    }
    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_Service');
    }
}
