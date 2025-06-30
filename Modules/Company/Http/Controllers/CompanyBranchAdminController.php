<?php

namespace Modules\Company\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Company\Entities\Company;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Entities\Location;
use Modules\Company\Entities\CompanyBranch;
use Modules\Company\Transformers\CompanyBranchTransformer;
use Modules\Company\Http\Requests\UpdateCompanyBranchRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class CompanyBranchAdminController extends Controller
{
    /**
     *  Fetch all branches for a company.
     */
    #[OpenApi\Operation('list', tags: ['Company Branch Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyBranchTransformer::class, isArray: true)]
    public function list(Request $request, Company $company)
    {
        if (!$company->can($request->user(), 'manage_branches')) {
            abort(403, 'You are not authorized to view branches for this company');
        }

        return CompanyBranchTransformer::collection(
            CompanyBranch::query()
                ->where('company_id', $company->id)
                ->when($request->search, function ($query, $search) {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->get()
        );
    }

    /**
     *  Retrieve a branch.
     */
    #[OpenApi\Operation('retrieve', tags: ['Company Branch Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyBranchTransformer::class)]
    public function retrieve(Request $request, Company $company, CompanyBranch $companyBranch): CompanyBranchTransformer
    {
        if (!$company->can($request->user(), 'manage_branches')) {
            abort(403, 'You are not authorized to view this branch');
        }

        return new CompanyBranchTransformer($companyBranch);
    }

    /**
     * Create a new branch.
     */
    #[OpenApi\Operation('create', tags: ['Company Branch Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateCompanyBranchRequest::class)]
    #[OpenApi\Response(factory: UpdateCompanyBranchRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: CompanyBranchTransformer::class)]
    public function create(UpdateCompanyBranchRequest $request, Company $company): CompanyBranchTransformer
    {
        if (!$company->can($request->user(), 'manage_branches')) {
            abort(403, 'You are not authorized to create branches for this company');
        }

        $branch = $company->branches()->create([
            ...$request->validated(),
            'creator_id' => $request->user()->id,
        ]);

        if ($request->location_id) {
            $location = Location::find($request->location_id);

            if ($location->creator_id == $request->user()->id) {
                $location->locationable_type = CompanyBranch::class;
                $location->locationable_id = $branch->id;
                $location->save();
                $branch->location_id = $location->id;
                $branch->save();
            }
        }

        return new CompanyBranchTransformer($branch);
    }

    /**
     * Update a branch.
     */
    #[OpenApi\Operation('update', tags: ['Company Branch Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateCompanyBranchRequest::class)]
    #[OpenApi\Response(factory: UpdateCompanyBranchRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: CompanyBranchTransformer::class)]
    public function update(UpdateCompanyBranchRequest $request, Company $company, CompanyBranch $companyBranch): CompanyBranchTransformer
    {
        if (!$company->can($request->user(), 'manage_branches')) {
            abort(403, 'You are not authorized to update this branch');
        }

        if ($companyBranch->company_id !== $company->id) {
            abort(403, 'You are not authorized to update this branch');
        }

        $companyBranch->update($request->validated());

        if ($request->location_id) {
            $location = Location::find($request->location_id);
            if ($location->creator_id == $request->user()->id) {
                $location->locationable_type = CompanyBranch::class;
                $location->locationable_id = $companyBranch->id;
                $location->save();
                $companyBranch->location_id = $location->id;
                $companyBranch->save();
            }
        }

        return new CompanyBranchTransformer($companyBranch);
    }

    /**
     * Delete a branch.
     */
    #[OpenApi\Operation('delete', tags: ['Company Branch Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyBranchTransformer::class)]
    public function delete(Request $request, Company $company, CompanyBranch $companyBranch)
    {
        if (!$company->can($request->user(), 'manage_branches')) {
            abort(403, 'You are not authorized to delete this branch');
        }

        if ($companyBranch->company_id !== $company->id) {
            abort(403, 'You are not authorized to delete this branch');
        }

        $companyBranch->delete();

        return $this->success('Branch deleted successfully.');
    }
}
