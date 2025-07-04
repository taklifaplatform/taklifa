<?php

namespace Modules\Cart\Policies;

use App\Models\User;
use Modules\Cart\Entities\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_cart');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cart $cart): bool
    {
        return $user->can('view_cart');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Cart creation is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cart $cart): bool
    {
        // Cart updating is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cart $cart): bool
    {
        // Cart deletion is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        // Bulk cart deletion is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Cart $cart): bool
    {
        // Force deletion is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        // Force bulk deletion is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Cart $cart): bool
    {
        // Restoration is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        // Bulk restoration is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Cart $cart): bool
    {
        // Replication is not allowed in admin - only viewing
        return false;
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        // Reordering is not allowed in admin - only viewing
        return false;
    }
} 