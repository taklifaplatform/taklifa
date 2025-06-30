<?php

namespace Modules\Shipment\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\DriverTransformer;
use Modules\Company\Transformers\CompanyTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class ShipmentContractTransformer extends JsonTransformer
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
            'status' => $this->status,
            'channel_id' => $this->channel_id,
            'driver' => DriverTransformer::make($this->driver),
            'company' => CompanyTransformer::make($this->company),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ShipmentContractTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('status')->required(),
                Schema::string('channel_id')->required(),

                Schema::ref('#/components/schemas/DriverTransformer', 'driver'),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company'),

                Schema::string('created_at')->required(),
                Schema::string('updated_at')->required(),
            );
    }
}
