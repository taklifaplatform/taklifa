<?php

namespace Modules\Shipment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Shipment\Entities\Shipment;
use Modules\Shipment\Transformers\ShipmentTransformer;
use Modules\Shipment\Http\Requests\UpdateShipmentRequest;
use Modules\Shipment\Transformers\ShipmentFilterTransformer;
use Modules\Shipment\Http\Requests\ListShipmentQueryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ShipmentController extends Controller
{
    /**
     * Fetch all shipments filters.
     */
    #[OpenApi\Operation('fetchShipmentFilters', tags: ['Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentFilterTransformer::class, isArray: true)]
    #[OpenApi\Parameters(factory: ListShipmentQueryRequest::class)]
    public function fetchShipmentFilters(ListShipmentQueryRequest $request)
    {
        return ShipmentFilterTransformer::collection(
            Shipment::query()
                ->filter($request)
                ->groupBy('status')
                ->orderBy('status', 'asc')
                ->selectRaw('count(*) as count, status')
                ->get()
        );
    }

    /**
     * Fetch all shipments.
     */
    #[OpenApi\Operation('fetchAllShipment', tags: ['Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListShipmentQueryRequest::class)]
    public function fetchAllShipment(ListShipmentQueryRequest $request)
    {
        return ShipmentTransformer::collection(
            Shipment::query()
                ->filter($request)
                ->latest()
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve a shipment.
     */
    #[OpenApi\Operation('retrieveShipment', tags: ['Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function retrieveShipment(Request $request, Shipment $shipment)
    {
        return new ShipmentTransformer($shipment);
    }

    /**
     * Retrieve a shipment by code.
     */
    #[OpenApi\Operation('retrieveShipmentByCode', tags: ['Shipment'])]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function retrieveShipmentByCode(Request $request, $code)
    {
        $shipment = Shipment::where('code', $code)->first();
        return new ShipmentTransformer($shipment);
    }

    /**
     * Store a new shipment.
     */
    #[OpenApi\Operation('storeShipment', tags: ['Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateShipmentRequest::class)]
    #[OpenApi\Response(factory: UpdateShipmentRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function storeShipment(UpdateShipmentRequest $request)
    {
        // Create the shipment
        $shipment = Shipment::create([
            'user_id' => $request->user()->id,
        ]);

        return $this->updateShipmentDetails($shipment, $request);
    }

    /**
     * Update a shipment.
     */
    #[OpenApi\Operation('updateShipment', tags: ['Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateShipmentRequest::class)]
    #[OpenApi\Response(factory: UpdateShipmentRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function updateShipment(Shipment $shipment, UpdateShipmentRequest $request)
    {
        // user can update only shipment
        if ($shipment->user_id !== $request->user()->id) {
            abort(403, 'You are not the owner of this message');
        }

        return $this->updateShipmentDetails($shipment, $request);
    }

    /**
     * Confirm a shipment.
     */
    #[OpenApi\Operation('confirmShipment', tags: ['Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function confirmShipment(Shipment $shipment, UpdateShipmentRequest $request)
    {
        return new ShipmentTransformer(
            $shipment->helper()->confirmShipment()->get()
        );
    }

    /**
     * Destroy a shipment.
     */
    #[OpenApi\Operation('destroyShipment', tags: ['Shipment'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentTransformer::class)]
    public function destroyShipment(Shipment $shipment, Request $request)
    {
        if ($shipment->user_id !== $request->user()->id) {
            abort(403, 'You are not the owner of this message');
        }

        DB::table('notifications')->where('data->model_id', $shipment->id)->delete();

        $shipment->delete();

        return $this->success('Shipment deleted successfully');
    }

    private function updateShipmentDetails(Shipment $shipment, UpdateShipmentRequest $request)
    {
        $shipment->update(
            $request->only([
                'pick_date',
                'pick_time',

                'deliver_date',
                'deliver_time',

                'from_location_id',
                'to_location_id',

                'recipient_name',
                'recipient_phone',

                'items_type',

                'selected_driver_id',
                'selected_company_id'
            ])
        );

        $this->handleShipmentItems($shipment, $request);
        $this->handleShipmentInvitation($shipment, $request);
        $this->handleShipmentBudget($shipment, $request);

        return new ShipmentTransformer(
            $shipment->refresh()
        );
    }

    private function handleShipmentItems(Shipment $shipment, UpdateShipmentRequest $request)
    {
        if (!$request->has('items')) {
            return;
        }

        $items = $request->get('items');

        $keepItems = [];
        foreach ($items as $item) {
            $shipmentItem = null;

            if (isset($item['id'])) {
                $shipmentItem = $shipment->items()->find($item['id']);
                $shipmentItem->update($item);
            } else {
                $shipmentItem = $shipment->items()->create($item);
            }

            $keepItems[] = $shipmentItem->id;

            if (isset($item['medias'])) {
                $this->addMultipleMedia($shipmentItem, $item['medias'], 'medias', true);
            }
        }

        $shipment->items()->whereNotIn('id', $keepItems)->delete();
    }

    private function handleShipmentInvitation(Shipment $shipment, UpdateShipmentRequest $request)
    {

        if (!$request->has('invitations')) {
            return;
        }

        $invitations = $request->get('invitations');

        $driversInvitations = [];
        $companiesInvitations = [];

        foreach ($invitations as $invitation) {
            if (isset($invitation['driver_id'])) {
                $driversInvitations[] = $invitation['driver_id'];
            }

            if (isset($invitation['company_id'])) {
                $companiesInvitations[] = $invitation['company_id'];
            }
        }

        $shipment->invitations()->whereNotNull('company_id')
            ->whereNotIn('company_id', $companiesInvitations)
            ->delete();

        $shipment->invitations()->whereNotNull('driver_id')
            ->whereNotIn('driver_id', $driversInvitations)
            ->delete();

        foreach ($driversInvitations as $driverId) {
            $shipment->invitations()->updateOrCreate([
                'driver_id' => $driverId,
            ]);
        }

        foreach ($companiesInvitations as $companyId) {
            $shipment->invitations()->updateOrCreate([
                'company_id' => $companyId,
            ]);
        }
    }

    private function handleShipmentBudget(Shipment $shipment, UpdateShipmentRequest $request)
    {
        $minBudgetData = $request->get('min_budget');
        if ($minBudgetData && array_key_exists('value', $minBudgetData)) {
            if (!$shipment->min_budget_id) {
                $budget = $shipment->prices()->create(
                    [
                        'currency_id' => $minBudgetData['currency_id'],
                        'value' => $minBudgetData['value'],
                    ]
                );
                $shipment->min_budget_id = $budget->id;
            } else {
                $shipment->minBudget()->update(
                    [
                        'currency_id' => $minBudgetData['currency_id'],
                        'value' => $minBudgetData['value'],
                    ]
                );
            }
        }

        $maxBudgetData = $request->get('max_budget');
        if ($maxBudgetData && array_key_exists('value', $maxBudgetData)) {
            if (!$shipment->max_budget_id) {
                $budget = $shipment->prices()->create(
                    [
                        'currency_id' => $maxBudgetData['currency_id'],
                        'value' => $maxBudgetData['value'],
                    ]
                );
                $shipment->max_budget_id = $budget->id;
            } else {
                $shipment->maxBudget()->update(
                    [
                        'currency_id' => $maxBudgetData['currency_id'],
                        'value' => $maxBudgetData['value'],
                    ]
                );
            }
        }
        $shipment->save();
    }
}
