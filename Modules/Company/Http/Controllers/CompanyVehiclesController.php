<?php

namespace Modules\Company\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Company\Entities\Company;
use Modules\Vehicle\Entities\Vehicle;
use Modules\Vehicle\Transformers\VehicleTransformer;
use Modules\Company\Http\Requests\ListCompanyVehiclesQueryRequest;

#[OpenApi\PathItem]
class CompanyVehiclesController extends Controller
{
    /**
     * Fetch all vehicles of a company
     */
    #[OpenApi\Operation('list', tags: ['Company Vehicles'])]
    #[OpenApi\Parameters(factory: ListCompanyVehiclesQueryRequest::class)]
    #[OpenApi\Response(factory: VehicleTransformer::class, isPagination: true)]
    public function list(ListCompanyVehiclesQueryRequest $request, Company $company)
    {
        return VehicleTransformer::collection(
            $company->vehicles()
                ->when($request->search, static function ($query, $search): void {
                    $query
                        ->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%')
                        ->orWhere('id', $search);
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve vehicle of a company
     */
    #[OpenApi\Operation('retrieve', tags: ['Company Vehicles'])]
    #[OpenApi\Response(factory: VehicleTransformer::class)]
    public function retrieve(Request $request, Company $company, Vehicle $vehicle)
    {
        if (! $company->vehicles()->find($vehicle->id)) {
            abort(403, 'Vehicle not found');
        }

        return VehicleTransformer::make($vehicle);
    }
}
