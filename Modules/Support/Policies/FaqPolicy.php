<?php

namespace Modules\Support\Policies;

use App\Models\User;
use Modules\Support\Entities\Faq;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any FAQs.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_faqs');
    }

    /**
     * Determine whether the user can view the FAQ.
     */
    public function view(User $user, Faq $faq): bool
    {
        return $user->can('view_faqs');
    }

    /**
     * Determine whether the user can create FAQs.
     */
    public function create(User $user): bool
    {
        return $user->can('create_faqs');
    }

    /**
     * Determine whether the user can update the FAQ.
     */
    public function update(User $user, Faq $faq): bool
    {
        return $user->can('update_faqs');
    }

    /**
     * Determine whether the user can delete the FAQ.
     */
    public function delete(User $user, Faq $faq): bool
    {
        return $user->can('delete_faqs');
    }

    /**
     * Determine whether the user can restore the FAQ.
     */
    public function restore(User $user, Faq $faq): bool
    {
        return $user->can('restore_faqs');
    }

    /**
     * Determine whether the user can permanently delete the FAQ.
     */
    public function forceDelete(User $user, Faq $faq): bool
    {
        return $user->can('force_delete_faqs');
    }
}
