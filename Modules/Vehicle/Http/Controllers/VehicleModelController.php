<?php

namespace Modules\Vehicle\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Vehicle\Entities\VehicleModel;
use Modules\Vehicle\Transformers\VehicleModelTransformer;

#[OpenApi\PathItem]
class VehicleModelController extends Controller
{
    /**
     * Fetch listing of the Vehicle Models.
     */
    #[OpenApi\Operation('list', tags: ['Vehicle Model'])]
    #[OpenApi\Response(factory: VehicleModelTransformer::class, isArray: true)]
    public function list()
    {
        $vehicles = VehicleModel::orderBy('order', 'asc')->get();

        return VehicleModelTransformer::collection($vehicles);
    }
}
