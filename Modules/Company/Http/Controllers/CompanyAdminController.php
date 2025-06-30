<?php

namespace Modules\Company\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Company\Entities\Company;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Entities\Location;
use Modules\Company\Transformers\CompanyTransformer;
use Modules\Company\Http\Requests\UpdateCompanyRequest;
use Modules\Company\Http\Requests\ListCompanyQueryRequest;
use Modules\User\Transformers\AuthenticatedUserTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class CompanyAdminController extends Controller
{
    /**
     *  Fetch all list admin companies.
     */
    #[OpenApi\Operation('list', tags: ['Company Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListCompanyQueryRequest::class)]
    public function list(ListCompanyQueryRequest $request)
    {
        return CompanyTransformer::collection(
            Company::query()
                ->where(function ($query) {
                    $query->where('owner_id', auth()->id())
                        ->orWhereHas('members', function ($query) {
                            $query->where('user_id', auth()->id());
                        });
                })
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     *  Retrieve admin company.
     */
    #[OpenApi\Operation('retrieve', tags: ['Company Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyTransformer::class)]
    public function retrieve(Company $company): CompanyTransformer
    {
        return new CompanyTransformer($company);
    }

    /**
     * Admin Create a company.
     */
    #[OpenApi\Operation('create', tags: ['Company Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateCompanyRequest::class)]
    #[OpenApi\Response(factory: UpdateCompanyRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: CompanyTransformer::class)]
    public function create(UpdateCompanyRequest $updateCompanyRequest): CompanyTransformer
    {
        $user = $updateCompanyRequest->user();

        $company = Company::create(
            [
                ...$updateCompanyRequest->validated(),
                'owner_id' => $user->id,
            ]
        );

        $company->members()->create([
            'user_id' => $user->id,
            'role' => 'company_manager',
        ]);

        if ($updateCompanyRequest->location_id) {
            $location = Location::find($updateCompanyRequest->location_id);

            if ($location->creator_id == $user->id) {
                $location->locationable_type = Company::class;
                $location->locationable_id = $company->id;
                $location->save();
                $company->location_id = $location->id;
                $company->save();
            }
        }

        $this->addSingleMedia($company, $updateCompanyRequest->get('logo'), 'logo');

        $this->addMultipleMedia($company, $updateCompanyRequest->get('legal_documents'), 'legal_documents');

        if (!$user->hasRole('company_owner')) {
            $user->assignRole('company_owner');
        }

        if (!$user->hasRole('company_manager')) {
            $user->assignRole('company_manager');
        }

        $this->activeCompanyRole($company, $user);

        return new CompanyTransformer($company);
    }

    /**
     * Admin Update a company.
     */
    #[OpenApi\Operation('update', tags: ['Company Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateCompanyRequest::class)]
    #[OpenApi\Response(factory: UpdateCompanyRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: CompanyTransformer::class)]
    public function update(UpdateCompanyRequest $updateCompanyRequest, Company $company)
    {
        $user = $updateCompanyRequest->user();

        if (!$company->can($user, 'update')) {
            abort(403, 'You are not authorized to update this resource');
        }

        $company->update(
            $updateCompanyRequest->validated()
        );

        if ($updateCompanyRequest->location_id) {
            $location = Location::find($updateCompanyRequest->location_id);

            if ($location->creator_id == $user->id || $location->locationable_id == $company->id) {
                $location->locationable_type = Company::class;
                $location->locationable_id = $company->id;
                $location->save();
                $company->location_id = $location->id;
                $company->save();
            }
        }

        $this->addSingleMedia($company, $updateCompanyRequest->get('logo'), 'logo');

        return $this->success('Company updated successfully.');
    }

    /**
     * Admin Delete a company.
     */
    #[OpenApi\Operation('delete', tags: ['Company Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CompanyTransformer::class)]
    public function delete(Company $company, Request $request)
    {
        $user = $request->user();

        if (!$company->can($user, 'delete')) {
            abort(403, 'You are not authorized to delete this resource');
        }

        $company->locations()->delete();
        $company->delete();

        if (!$user->companies()->count()) {
            $user->removeRole('company_owner');
            $user->removeRole('company_manager');
        }

        return $this->success('Company deleted successfully.');
    }

    /**
     * Active company.
     */
    #[OpenApi\Operation('changeActiveCompany', tags: ['Company Admin'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function changeActiveCompany(Company $company, Request $request): AuthenticatedUserTransformer
    {
        return new AuthenticatedUserTransformer(
            $this->activeCompanyRole($company, $request->user())
        );
    }

    private function activeCompanyRole(Company $company, User $user): User
    {
        $membership = $company->members()->where('user_id', $user->id)->first();

        if (!$membership) {
            abort(403, 'You are not authorized to activate this company.');
        }

        $user->active_company_id = $company->id;
        $user->save();

        $user->setActiveRole($membership->role);

        return $user;
    }
}
