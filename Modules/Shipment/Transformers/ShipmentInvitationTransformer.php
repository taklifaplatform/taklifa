<?php

namespace Modules\Shipment\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Company\Transformers\CompanyTransformer;
use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\DriverTransformer;

class ShipmentInvitationTransformer extends JsonTransformer
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
            'id' => $this->id,
            'shipment_id' => $this->shipment_id,
            'proposal_id' => $this->proposal?->id,
            'status' => $this->status,
            'driver' => DriverTransformer::make($this->driver),
            'company' => CompanyTransformer::make($this->company),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ShipmentInvitationTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('shipment_id')->required(),
                Schema::string('proposal_id')->required(),
                Schema::string('status'),
                Schema::ref('#/components/schemas/DriverTransformer', 'driver')->required(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company')->required(),
            );
    }
}
