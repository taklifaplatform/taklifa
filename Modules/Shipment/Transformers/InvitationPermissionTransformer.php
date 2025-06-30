<?php

namespace Modules\Shipment\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class InvitationPermissionTransformer extends JsonTransformer
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
            'invitation' => ShipmentInvitationTransformer::make($this->resource['invitation']),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('InvitationPermissionTransformer')
            ->properties(
                Schema::boolean('has_invitation')->required(),
                Schema::ref('#/components/schemas/ShipmentInvitationTransformer', 'invitation')->required(),
            );
    }
}
