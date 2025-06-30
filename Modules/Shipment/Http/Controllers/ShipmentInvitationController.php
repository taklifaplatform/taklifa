<?php

namespace Modules\Shipment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Shipment\Entities\Shipment;
use Modules\Shipment\Entities\ShipmentInvitation;
use Modules\Shipment\Http\Requests\AcceptInvitationRequest;
use Modules\Shipment\Transformers\ShipmentInvitationTransformer;
use Modules\Shipment\Transformers\InvitationPermissionTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Modules\Shipment\Http\Requests\ListShipmentInvitationQueryRequest;

#[OpenApi\PathItem]
class ShipmentInvitationController extends Controller
{
    /**
     * Fetch all invitations for specific shipment.
     */
    #[OpenApi\Operation('fetchShipmentInvitations', tags: ['Shipment Invitation'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentInvitationTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListShipmentInvitationQueryRequest::class)]
    public function fetchShipmentInvitations(ListShipmentInvitationQueryRequest $request, Shipment $shipment)
    {
        return ShipmentInvitationTransformer::collection(
            $shipment->invitations()
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve current user invitation permissions.
     * Can be used by (provider, customer)
     */
    #[OpenApi\Operation('getPermissions', tags: ['Shipment Invitation'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: InvitationPermissionTransformer::class)]
    public function getPermissions(Request $request, Shipment $shipment)
    {
        $invitation = $shipment->helper()->getCurrentProviderPendingInvitation();

        return InvitationPermissionTransformer::make([
            'has_invitation' => !!$invitation,
            'invitation' => $invitation
        ]);
    }

    /**
     * Retrieve a shipment invitation.
     * TODO: make sure current auth can view this invitation.
     */
    #[OpenApi\Operation('retrieveShipmentInvitation', tags: ['Shipment Invitation'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentInvitationTransformer::class)]
    public function retrieveShipmentInvitation(Request $request, Shipment $shipment, ShipmentInvitation $shipmentInvitation)
    {
        return new ShipmentInvitationTransformer($shipmentInvitation);
    }

    /**
     * Accept shipment invitation.
     */
    #[OpenApi\Operation('acceptShipmentInvitation', tags: ['Shipment Invitation'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: AcceptInvitationRequest::class)]
    #[OpenApi\Response(factory: AcceptInvitationRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ShipmentInvitationTransformer::class)]
    public function acceptShipmentInvitation(AcceptInvitationRequest $request, Shipment $shipment, ShipmentInvitation $shipmentInvitation)
    {

        $data = [
            ...$request->validated(),
            'shipment_id' => $shipmentInvitation->shipment_id,
            'driver_id' => $shipmentInvitation->driver_id,
            'company_id' => $shipmentInvitation->company_id,
        ];

        if ($shipmentInvitation->proposal) {
            $proposal = $shipmentInvitation->proposal;
            $proposal->update($data);
        } else {
            $proposal = $shipmentInvitation->proposal()->create($data);
        }

        if ($request->get('cost')) {
            $cost = $proposal->prices()->create(
                $request->get('cost')
            );
            $proposal->cost_id = $cost->id;
        }

        if ($request->get('fee')) {
            $fee = $proposal->prices()->create(
                $request->get('fee')
            );
            $proposal->fee_id = $fee->id;
        }
        $proposal->save();

        $shipment->helper()
            ->acceptInvitation($shipmentInvitation)
            ->handleNewProposal($proposal);

        return new ShipmentInvitationTransformer($shipmentInvitation);
    }

    /**
     * Decline shipment invitation.
     */
    #[OpenApi\Operation('declineShipmentInvitation', tags: ['Shipment Invitation'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentInvitationTransformer::class)]
    public function declineShipmentInvitation(Request $request, Shipment $shipment, ShipmentInvitation $shipmentInvitation)
    {
        $shipment->helper()->declineInvitation($shipmentInvitation);

        return new ShipmentInvitationTransformer($shipmentInvitation);
    }

    /**
     * Remove shipment invitation.
     */
    #[OpenApi\Operation('removeShipmentInvitation', tags: ['Shipment Invitation'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentInvitationTransformer::class)]
    public function removeShipmentInvitation(Request $request, Shipment $shipment, ShipmentInvitation $shipmentInvitation)
    {
        $shipment->helper()->removeInvitation($shipmentInvitation);

        return new ShipmentInvitationTransformer($shipmentInvitation);
    }
}
