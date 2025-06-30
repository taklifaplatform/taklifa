<?php

namespace Modules\Support\Policies;

use App\Models\User;
use Modules\Support\Entities\ReportReason;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportReasonPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_report::reason');
    }

    public function view(User $user, ReportReason $reportReason): bool
    {
        return $user->can('view_report::reason');
    }

    public function create(User $user): bool
    {
        return $user->can('create_report::reason');
    }

    public function update(User $user, ReportReason $reportReason): bool
    {
        return $user->can('update_report::reason');
    }

    public function delete(User $user, ReportReason $reportReason): bool
    {
        return $user->can('delete_report::reason');
    }

    public function restore(User $user, ReportReason $reportReason): bool
    {
        return $user->can('restore_report::reason');
    }

    public function forceDelete(User $user, ReportReason $reportReason): bool
    {
        return $user->can('force_delete_report::reason');
    }

    public function replicate(User $user, ReportReason $reportReason): bool
    {
        return $user->can('replicate_report::reason');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_report::reason');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_report::reason');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_report::reason');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_report::reason');
    }

    public function replicateAny(User $user): bool
    {
        return $user->can('replicate_any_report::reason');
    }

    public function reorderAny(User $user): bool
    {
        return $user->can('reorder_any_report::reason');
    }
}
