<?php

namespace Modules\Company\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Company\Entities\Company;
use Modules\Api\Attributes as OpenApi;
use Modules\Company\Entities\CompanyInvitation;
use Modules\Notification\Jobs\SendNotificationJob;
use Modules\Company\Http\Requests\UpdateInvitationRequest;
use Modules\Company\Http\Requests\ListInvitationQueryRequest;
use Modules\Company\Transformers\CompanyInvitationTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Modules\Company\Notifications\MemberInvitation\CompanyDeleteInvitation;
use Modules\Company\Notifications\MemberInvitation\CompanyUpdateInvitation;

#[OpenApi\PathItem]
class CompanyInvitationController extends Controller
{
    /**
     * Fetch All Company Invitations.
     */
    #[OpenApi\Operation('list', tags: ['Company Invitations'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListInvitationQueryRequest::class)]
    #[OpenApi\Response(factory: CompanyInvitationTransformer::class, isPagination: true)]
    public function list(ListInvitationQueryRequest $request, Company $company)
    {
        $user = $request->user();

        if (! $company->can($user, 'manage_invitations')) {
            abort(403, 'You are not authorized to view this resource');
        }

        return CompanyInvitationTransformer::collection(
            $company->invitations()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->when($request->role, static function ($query, $role): void {
                    $query->where('role', $role);
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve Company Invitation.
     */
    #[OpenApi\Operation('retrieve', tags: ['Company Invitations'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyInvitationTransformer::class)]
    public function retrieve(Request $request, Company $company, CompanyInvitation $companyInvitation)
    {
        $user = $request->user();

        if (! $company->can($user, 'manage_invitations')) {
            abort(403, 'You are not authorized to view this resource');
        }

        if ($company->id !== $companyInvitation->company_id) {
            abort(403, 'You are not authorized to view this resource');
        }

        return CompanyInvitationTransformer::make($companyInvitation);
    }

    /**
     * Invite Driver to Company.
     */
    #[OpenApi\Operation('create', tags: ['Company Invitations'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateInvitationRequest::class)]
    #[OpenApi\Response(factory: UpdateInvitationRequest::class, statusCode: 422)]
    public function create(UpdateInvitationRequest $request, Company $company)
    {
        $user = $request->user();

        if (! $company->can($user, 'manage_driver_invitations')) {
            abort(403, 'You are not authorized to view this resource');
        }

        $companyInvitation = $company->invitations()->create([
            ...$request->validated(),
            'sender_id' => $user->id,
            'invitation_code' => Str::random(20),
        ]);

        $companyInvitation->sendInvitation();

        return $this->success('Driver invitation request has been sent successfully');
    }

    /**
     * Update Driver Invitation
     */
    #[OpenApi\Operation('update', tags: ['Company Invitations'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateInvitationRequest::class)]
    #[OpenApi\Response(factory: UpdateInvitationRequest::class, statusCode: 422)]
    public function update(UpdateInvitationRequest $request, Company $company, CompanyInvitation $companyInvitation)
    {
        $user = $request->user();

        if (! $company->can($user, 'manage_driver_invitations')) {
            abort(403, 'You are not authorized to update this resource');
        }

        if ($company->id !== $companyInvitation->company_id) {
            abort(403, 'You are not authorized to update this resource');
        }

        $companyInvitation->update($request->validated());

        $companyInvitation->notify(new CompanyUpdateInvitation($companyInvitation));

        return $this->success('Driver invitation request has been updated successfully');
    }

    /**
     * Delete Driver Invitation
     */
    #[OpenApi\Operation('delete', tags: ['Company Invitations'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyInvitationTransformer::class)]
    public function delete(Request $request, Company $company, CompanyInvitation $companyInvitation)
    {
        $user = $request->user();

        if (! $company->can($user, 'manage_driver_invitations')) {
            abort(403, 'You are not authorized to view this resource');
        }

        if ($company->id !== $companyInvitation->company_id) {
            abort(403, 'You are not authorized to delete this invitation request');
        }

        try {
            $companyInvitation->notify(new CompanyDeleteInvitation($companyInvitation));
        } catch (Exception $e) {
            //
        }
        $companyInvitation->delete();

        return $this->success('Driver invitation request has been deleted successfully');
    }
}
