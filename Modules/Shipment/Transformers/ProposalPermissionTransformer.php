<?php

namespace Modules\Shipment\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ProposalPermissionTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            ...parent::toArray($request),
            'proposal' => ShipmentProposalTransformer::make($this->resource['proposal']),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProposalPermissionTransformer')
            ->properties(
                Schema::boolean('can_submit')->required(),
                Schema::boolean('has_proposal')->required(),
                Schema::boolean('can_edit')->required(),
                Schema::ref('#/components/schemas/ShipmentProposalTransformer', 'proposal')->required(),
            );
    }
}
