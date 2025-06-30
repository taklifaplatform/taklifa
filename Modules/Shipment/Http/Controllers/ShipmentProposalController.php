<?php

namespace Modules\Shipment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Shipment\Entities\Shipment;
use Modules\Shipment\Entities\ShipmentProposal;
use Modules\Shipment\Http\Requests\AcceptInvitationRequest;
use Modules\Shipment\Transformers\ShipmentProposalTransformer;
use Modules\Shipment\Transformers\ProposalPermissionTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Modules\Shipment\Http\Requests\ListShipmentInvitationQueryRequest;

#[OpenApi\PathItem]
class ShipmentProposalController extends Controller
{
    /**
     * Fetch all proposal for specific shipment.
     */
    #[OpenApi\Operation('fetchShipmentProposals', tags: ['Shipment Proposal'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentProposalTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListShipmentInvitationQueryRequest::class)]
    public function fetchShipmentProposals(ListShipmentInvitationQueryRequest $request, Shipment $shipment)
    {
        return ShipmentProposalTransformer::collection(
            $shipment->proposals()
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve current user proposal permissions.
     * Can be used by (provider, customer)
     */
    #[OpenApi\Operation('getPermissions', tags: ['Shipment Proposal'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ProposalPermissionTransformer::class)]
    public function getPermissions(Request $request, Shipment $shipment)
    {
        $helper = $shipment->helper();
        $proposal = $helper->getCurrentProviderProposal();
        return ProposalPermissionTransformer::make([
            'can_submit' => $helper->canSubmitProposal(),
            'has_proposal' => !!$proposal,
            'proposal' => $proposal,
            'can_edit' => !$proposal?->locked,
        ]);
    }

    /**
     * Retrieve a shipment proposal.
     */
    #[OpenApi\Operation('retrieveShipmentProposal', tags: ['Shipment Proposal'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentProposalTransformer::class)]
    public function retrieveShipmentProposal(Request $request, Shipment $shipment, ShipmentProposal $shipmentProposal)
    {
        return ShipmentProposalTransformer::make($shipmentProposal);
    }

    /**
     * Accept shipment invitation.
     */
    #[OpenApi\Operation('acceptShipmentProposal', tags: ['Shipment Proposal'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentProposalTransformer::class)]
    public function acceptShipmentProposal(Request $request, Shipment $shipment, ShipmentProposal $shipmentProposal)
    {
        $shipment->helper()->acceptProposal($shipmentProposal);

        return new ShipmentProposalTransformer($shipmentProposal);
    }

    /**
     * Decline shipment invitation.
     */
    #[OpenApi\Operation('declineShipmentProposal', tags: ['Shipment Proposal'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentProposalTransformer::class)]
    public function declineShipmentProposal(Request $request, Shipment $shipment, ShipmentProposal $shipmentProposal)
    {
        $shipment->helper()->declineProposal($shipmentProposal);

        return new ShipmentProposalTransformer($shipmentProposal);
    }

    /**
     * Decline shipment invitation.
     */
    #[OpenApi\Operation('editShipmentProposal', tags: ['Shipment Proposal'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: AcceptInvitationRequest::class)]
    #[OpenApi\Response(factory: AcceptInvitationRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ShipmentProposalTransformer::class)]
    public function editShipmentProposal(AcceptInvitationRequest $request, Shipment $shipment, ShipmentProposal $shipmentProposal)
    {
        $shipment->helper()->canEditProposal($shipmentProposal);

        $shipmentProposal->update($request->validated());

        if ($request->get('cost')) {
            $shipmentProposal->cost()->update(
                $request->get('cost')
            );
        }

        if ($request->get('fee')) {
            $shipmentProposal->fee()->update(
                $request->get('fee')
            );
        }

        return new ShipmentProposalTransformer($shipmentProposal);
    }
}
