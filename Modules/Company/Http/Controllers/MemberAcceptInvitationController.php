<?php

namespace Modules\Company\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Api\Attributes as OpenApi;
use App\Http\Controllers\Controller;
use Modules\Company\Entities\CompanyInvitation;
use Modules\Auth\Transformers\AuthTokenTransformer;
use Modules\Company\Http\Requests\AcceptInviteRequest;
use Modules\Company\Transformers\CompanyInvitationTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class MemberAcceptInvitationController extends Controller
{
    /**
     * Driver Retrieve Invitation By Code.
     */
    #[OpenApi\Operation('retrieve', tags: ['Company Member Invitation'])]
    #[OpenApi\Response(factory: CompanyInvitationTransformer::class)]
    public function retrieve(Request $request, string $invitationCode)
    {
        $invitation = CompanyInvitation::where('invitation_code', $invitationCode)->first();

        if (! $invitation) {
            abort(403, 'Invitation code not found');
        }

        return new CompanyInvitationTransformer($invitation);
    }

    /**
     * Driver Accept a invitation.
     */
    #[OpenApi\Operation('accept', tags: ['Company Member Invitation'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: AuthTokenTransformer::class)]
    public function accept(Request $request, string $invitationCode)
    {
        $user = $request->user();

        $invitation = CompanyInvitation::where('invitation_code', $invitationCode)->first();

        if (! $invitation) {
            abort(403, __('Invitation code not found'));
        }

        $company = $invitation->company;

        if ($company->members()->where('user_id', $request->user()->id)->exists()) {
            return $this->success(__('You are already a member of this company'));
        }

        $company->members()->create([
            'user_id' => $user->id,
            'role' => $invitation->role,
        ]);

        if (! $user->hasRole('company_manager') && $invitation->role === 'company_manager') {
            $user->assignRole('company_manager');
        }

        $invitation->delete();

        return $this->success(__('Invitation accepted successfully'));
    }

    /**
     * Driver Reject a invitation.
     */
    #[OpenApi\Operation('reject', tags: ['Company Member Invitation'], security: BearerTokenSecurityScheme::class)]
    public function reject(Request $request, string $invitationCode)
    {
        $invitation = CompanyInvitation::where('invitation_code', $invitationCode)->first();

        if (! $invitation) {
            abort(403, __('Invitation code not found'));
        }

        $invitation->update([
            'is_rejected' => true
        ]);

        return $this->success(__('Invitation rejected successfully'));
    }
}
