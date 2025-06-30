<?php

namespace Modules\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Company\Entities\Company;
use Modules\Api\Attributes as OpenApi;
use Illuminate\Support\Facades\Request;
use Modules\Company\Entities\CompanyBranch;
use Modules\Company\Transformers\CompanyBranchTransformer;

#[OpenApi\PathItem]
class CompanyBranchController extends Controller
{
    /**
     *  Fetch all companies.
     */
    #[OpenApi\Operation('fetchAllBranches', tags: ['Company Branch'])]
    #[OpenApi\Response(factory: CompanyBranchTransformer::class, isArray: true)]
    public function fetchAllBranches(Request $request, Company $company)
    {
        return CompanyBranchTransformer::collection(
            CompanyBranch::query()
                ->where('company_id', $company->id)
                ->get()
        );
    }

    /**
     *  Retrieve a company.
     */
    #[OpenApi\Operation('retrieveBranch', tags: ['Company Branch'])]
    #[OpenApi\Response(factory: CompanyBranchTransformer::class)]
    public function retrieveBranch(Company $company, CompanyBranch $companyBranch): CompanyBranchTransformer
    {
        return CompanyBranchTransformer::make($companyBranch);
    }
}
