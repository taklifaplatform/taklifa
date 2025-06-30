<?php

namespace Modules\Services\Http\Controllers;

use App\Models\User;
use Modules\Api\Attributes as OpenApi;
use Modules\Company\Entities\Company;
use Modules\Services\Entities\Service;
use App\Http\Controllers\Controller;
use Modules\Services\Transformers\ServiceTransformer;
use Modules\Services\Http\Requests\ListServiceRequest;

#[OpenApi\PathItem]
class ServicesController extends Controller
{
    /**
     * Display the list of services
     */
    #[OpenApi\Operation('listServices', tags: ['Services'])]
    #[OpenApi\Response(factory: ServiceTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListServiceRequest::class)]
    public function listServices(ListServiceRequest $request)
    {
        return ServiceTransformer::collection(
            Service::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('title', 'like', sprintf('%%%s%%', $search));
                })
                ->latest()
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve a service
     */
    #[OpenApi\Operation('retrieveZoneService', tags: ['Services'])]
    #[OpenApi\Response(factory: ServiceTransformer::class)]
    public function retrieveZoneService(Service $service): ServiceTransformer
    {
        return new ServiceTransformer($service);
    }

    /**
     * Display the list of services for a company
     */
    #[OpenApi\Operation('listCompanyServices', tags: ['Services'])]
    #[OpenApi\Response(factory: ServiceTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListServiceRequest::class)]
    public function listCompanyServices(ListServiceRequest $request, Company $company)
    {
        return ServiceTransformer::collection(
            $company->services()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('title', 'like', sprintf('%%%s%%', $search));
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Display the list of services for a driver
     */
    #[OpenApi\Operation('listDriverServices', tags: ['Services'])]
    #[OpenApi\Response(factory: ServiceTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListServiceRequest::class)]
    public function listDriverServices(ListServiceRequest $request , User $driver)
    {
        return ServiceTransformer::collection(
            $driver->services()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('title', 'like', sprintf('%%%s%%', $search));
                })
                ->paginate($request->per_page ?? 10)
        );
    }

}
