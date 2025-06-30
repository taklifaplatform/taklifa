<?php

namespace Modules\Shipment\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ShipmentFilterTransformer extends JsonTransformer
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
            'status' => $this->status,
            'count' => $this->count,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ShipmentFilterTransformer')
            ->properties(
                Schema::string('status')->nullable(),
                Schema::integer('count')->nullable()
            );
    }
}
