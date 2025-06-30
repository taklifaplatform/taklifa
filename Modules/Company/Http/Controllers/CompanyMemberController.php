<?php

namespace Modules\Company\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Company\Entities\Company;
use Modules\Api\Attributes as OpenApi;
use Modules\Company\Entities\CompanyMember;
use Modules\Company\Transformers\CompanyMemberTransformer;
use Modules\Company\Http\Requests\ListCompanyMembersQueryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class CompanyMemberController extends Controller
{
    /**
     * Fetch all members of a company
     */
    #[OpenApi\Operation('list', tags: ['Company Members'])]
    #[OpenApi\Parameters(factory: ListCompanyMembersQueryRequest::class)]
    #[OpenApi\Response(factory: CompanyMemberTransformer::class, isPagination: true)]
    public function list(ListCompanyMembersQueryRequest $request, Company $company)
    {
        return CompanyMemberTransformer::collection(
            $company->members()
                ->when($request->search, static function ($query, $search): void {
                    $query->whereHas('user', static function ($query) use ($search): void {
                        $query
                            ->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%')
                            ->orWhere('id', $search);
                    });
                })
                ->when($request->status, static function ($query, $status): void {
                    $query->whereHas('user', static function ($query) use ($status): void {
                        $query->where('status', $status);
                    });
                })
                ->when($request->role, static function ($query, $role): void {
                    $query->where('role', $role);
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve member of a company
     */
    #[OpenApi\Operation('retrieve', tags: ['Company Members'])]
    #[OpenApi\Response(factory: CompanyMemberTransformer::class)]
    public function retrieve(Request $request, Company $company, CompanyMember $member)
    {
        if (! $company->members()->find($member->id)) {
            abort(403, 'Member not found');
        }

        return CompanyMemberTransformer::make($member);
    }

    /**
     * Delete member of a company
     */
    #[OpenApi\Operation('delete', tags: ['Company Members'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyMemberTransformer::class)]
    public function delete(Request $request, Company $company, string $member)
    {
        $user = $request->user();

        if (! $company->can($user, 'manage_members')) {
            abort(403, 'You are not authorized to view this resource');
        }

        $membership = $company->members()->where('user_id', $member)->first();

        if (! $membership) {
            abort(403, 'Member not found');
        }

        if ($membership->user_id === $user->id) {
            abort(403, 'You cannot delete yourself');
        }

        if ($membership->user_id === $company->owner_id) {
            abort(403, 'You cannot delete the company owner');
        }

        $membership->delete();

        return $this->success('Member has been deleted successfully');
    }
}
