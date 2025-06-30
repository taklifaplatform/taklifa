<?php

namespace Modules\Shipment\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Company\Transformers\CompanyTransformer;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Geography\Transformers\PriceTransformer;
use Modules\User\Transformers\DriverTransformer;

class ShipmentProposalTransformer extends JsonTransformer
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
            'channel_id' => $this->channel_id,
            'status' => $this->status,
            'message' => $this->message,

            'driver' => DriverTransformer::make($this->driver),
            'company' => CompanyTransformer::make($this->company),

            'cost' => PriceTransformer::make($this->cost),
            'fee' => PriceTransformer::make($this->fee),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ShipmentProposalTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('shipment_id')->required(),

                Schema::string('channel_id'),
                Schema::string('status'),
                Schema::string('message'),

                Schema::ref('#/components/schemas/DriverTransformer', 'driver')->required(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company')->required(),

                Schema::ref('#/components/schemas/PriceTransformer', 'cost')->required(),
                Schema::ref('#/components/schemas/PriceTransformer', 'fee')->required(),
            );
    }
}
