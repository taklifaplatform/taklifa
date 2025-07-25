<?php

namespace Modules\Cart\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Cart\Transformers\CartItemTransformer;

class CartTransformer extends JsonTransformer
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
            'user_id' => $this->user_id,
            'code' => $this->code,
            'total_items' => $this->total_items,
            'total_cost' => $this->total_cost,
            'items' => CartItemTransformer::collection($this->items),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CartTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('user_id')->nullable(),
                Schema::string('device_identifier')->required(),
                Schema::string('company_id')->required(),
                Schema::integer('total_items')->required(),
                Schema::number('total_cost')->required(),
                Schema::array('items')
                    ->items(Schema::ref('#/components/schemas/CartItemTransformer'))
                    ->nullable(),
            );
    }
}
