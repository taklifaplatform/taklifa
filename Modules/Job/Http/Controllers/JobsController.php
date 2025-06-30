<?php

namespace Modules\Job\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Shipment\Entities\Shipment;
use Modules\Job\Http\Requests\ListJobsQueryRequest;
use Modules\Shipment\Transformers\ShipmentTransformer;

#[OpenApi\PathItem]
class JobsController extends Controller
{
    /**
     * List All public Jobs.
     */
    #[OpenApi\Operation('listJobs', tags: ['Job'])]
    #[OpenApi\Response(factory: ShipmentTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListJobsQueryRequest::class)]
    public function listJobs(ListJobsQueryRequest $request)
    {
        $query = Shipment::query();

        return ShipmentTransformer::collection(
            $query->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve specific job.
     */
    #[OpenApi\Operation('retrieveJob', tags: ['Job'])]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function retrieveJob(Request $request, Shipment $job)
    {
        return ShipmentTransformer::make(
            $job
        );
    }
}
