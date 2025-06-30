<?php

namespace Modules\QuickShipment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Shipment\Entities\Shipment;
use Modules\QuickShipment\Entities\QuickShipment;
use Modules\Shipment\Transformers\ShipmentTransformer;
use Modules\Shipment\Http\Requests\ListShipmentQueryRequest;
use Modules\QuickShipment\Transformers\QuickShipmentTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Modules\QuickShipment\Http\Requests\UpdateQuickShipmentRequest;

#[OpenApi\PathItem]
class QuickShipmentController extends Controller
{
    /**
     * Fetch all shipments.
     */
    #[OpenApi\Operation('fetchUserShipments', tags: ['Quick Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListShipmentQueryRequest::class)]
    public function fetchUserShipments(ListShipmentQueryRequest $request)
    {
        return QuickShipmentTransformer::collection(
            QuickShipment::query()
                ->where('user_id', $request->user()->id)
                ->latest()
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Fetch all shipments.
     */
    #[OpenApi\Operation('fetchDriverShipments', tags: ['Quick Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListShipmentQueryRequest::class)]
    public function fetchDriverShipments(ListShipmentQueryRequest $request)
    {
        return QuickShipmentTransformer::collection(
            QuickShipment::query()
                ->where('driver_id', $request->user()->id)
                ->latest()
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve a shipment.
     */
    #[OpenApi\Operation('retrieveQuickShipment', tags: ['Quick Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: QuickShipmentTransformer::class)]
    public function retrieveShipment(Request $request, QuickShipment $quickShipment)
    {
        return QuickShipmentTransformer::make($quickShipment);
    }

    /**
     * Store a new shipment.
     */
    #[OpenApi\Operation('storeShipment', tags: ['Quick Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateQuickShipmentRequest::class)]
    #[OpenApi\Response(factory: UpdateQuickShipmentRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function storeShipment(UpdateQuickShipmentRequest $request)
    {
        // Create the shipment
        $quickShipment = QuickShipment::create([
            'user_id' => $request->user()->id,
            ...$request->only([
                'driver_id',
                'date',
                'notes',
                'price',
            ]),
        ]);

        // TODO: send notification to the driver

        return $this->updateShipmentDetails($quickShipment, $request);
    }

    /**
     * Update a shipment.
     */
    #[OpenApi\Operation('updateShipment', tags: ['Quick Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateQuickShipmentRequest::class)]
    #[OpenApi\Response(factory: UpdateQuickShipmentRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function updateShipment(QuickShipment $quickShipment, UpdateQuickShipmentRequest $request)
    {
        // user can update only shipment
        if ($quickShipment->user_id !== $request->user()->id) {
            abort(403, 'You are not the owner of this shipment');
        }

        return $this->updateShipmentDetails($quickShipment, $request);
    }

    /**
     * Destroy a shipment.
     */
    #[OpenApi\Operation('acceptShipment', tags: ['Quick Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function acceptShipment(QuickShipment $quickShipment, Request $request)
    {
        if ($quickShipment->driver_id !== $request->user()->id) {
            abort(403, 'You cannot accept this shipment');
        }

        $quickShipment->is_accepted = true;
        $quickShipment->save();

        // TODO: send notification to the user

        return QuickShipmentTransformer::make($quickShipment);
    }

    private function updateShipmentDetails(QuickShipment $quickShipment, UpdateQuickShipmentRequest $request)
    {
        $quickShipment->update(
            $request->only([
                'driver_id',
                'date',
                'notes',
                'price',
            ])
        );

        if (isset($request->medias)) {
            $this->addMultipleMedia($quickShipment, $request->medias, 'medias', true);
        }


        return QuickShipmentTransformer::make(
            $quickShipment->refresh()
        );
    }

    /**
     * Destroy a shipment.
     */
    #[OpenApi\Operation('destroyShipment', tags: ['Quick Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function destroyShipment(QuickShipment $quickShipment, Request $request)
    {
        if ($quickShipment->user_id !== $request->user()->id) {
            abort(403, 'You are not the owner of this shipment');
        }

        $quickShipment->delete();

        return $this->success('Shipment deleted successfully');
    }
}
