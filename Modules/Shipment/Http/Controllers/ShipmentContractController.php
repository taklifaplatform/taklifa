<?php

namespace Modules\Shipment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Shipment\Entities\Shipment;
use Modules\Shipment\Entities\ShipmentContract;
use Modules\Shipment\Entities\ShipmentProposal;
use Modules\Shipment\Transformers\ShipmentContractTransformer;
use Modules\Shipment\Transformers\ShipmentProposalTransformer;
use Modules\Shipment\Transformers\ProposalPermissionTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ShipmentContractController extends Controller
{
    /**
     * Fetch shipment contract.
     */
    #[OpenApi\Operation('fetchShipmentContract', tags: ['Shipment Contract'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentContractTransformer::class)]
    public function fetchShipmentContract(Request $request, ShipmentContract $shipmentContract)
    {
        return ShipmentContractTransformer::make(
            $shipmentContract
        );
    }

    /**
     * Retrieve current user contract permissions.
     * Can be used by (provider, customer)
     */
    #[OpenApi\Operation('getPermissions', tags: ['Shipment Contract'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ProposalPermissionTransformer::class)]
    public function getPermissions(Request $request, Shipment $shipment)
    {
        $helper = $shipment->helper();
        $proposal = $helper->getCurrentProviderProposal();
        return ProposalPermissionTransformer::make([
            'can_accept_contract' => $helper->canSubmitProposal(),
            'can_cancel_contract' => !!$proposal,
        ]);
    }

    /**
     * Convert Proposal into contract.
     */
    #[OpenApi\Operation('createProposalContract', tags: ['Shipment Contract'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentProposalTransformer::class)]
    public function createProposalContract(Request $request, ShipmentProposal $shipmentProposal)
    {
        $shipmentProposal->shipment->helper()->createProposalContract($shipmentProposal);

        return new ShipmentProposalTransformer($shipmentProposal);
    }


    /**
     * Cancel contract.
     */
    #[OpenApi\Operation('cancelContract', tags: ['Shipment Contract'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: ShipmentProposalTransformer::class)]
    public function cancelContract(Request $request, ShipmentContract $shipmentContract)
    {
        $shipmentContract->shipment->helper()->cancelContract($shipmentContract);

        return response()->json(['message' => 'Shipment Contract deleted successfully']);
    }
}
