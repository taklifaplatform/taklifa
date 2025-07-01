<?php

namespace Modules\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Company\Entities\Company;
use Modules\Api\Attributes as OpenApi;
use Modules\Company\Transformers\CompanyTransformer;
use Modules\Company\Http\Requests\ListCompanyQueryRequest;

#[OpenApi\PathItem]
class CompanyController extends Controller
{
    /**
     *  Fetch all companies.
     */
    #[OpenApi\Operation('fetchAllCompanies', tags: ['Companies'])]
    #[OpenApi\Response(factory: CompanyTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListCompanyQueryRequest::class)]
    public function fetchAllCompanies(ListCompanyQueryRequest $request)
    {
        return CompanyTransformer::collection(
            Company::query()
                ->active()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     *  Retrieve a company.
     */
    #[OpenApi\Operation('retrieveCompany', tags: ['Companies'])]
    #[OpenApi\Response(factory: CompanyTransformer::class)]
    public function retrieveCompany(Company $company): CompanyTransformer
    {
        return new CompanyTransformer($company);
    }
}
