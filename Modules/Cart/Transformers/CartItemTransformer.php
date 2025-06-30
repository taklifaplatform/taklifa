<?php

namespace Modules\Cart\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class CartItemTransformer extends JsonTransformer
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
            'cart_id' => $this->cart_id,
            'product_id' => $this->product_id,
            'variant_id' => $this->variant_id,
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'product' => $this->whenLoaded('product', fn() => new \Modules\Product\Transformers\ProductTransformer($this->product)),
            'variant' => $this->whenLoaded('variant', fn() => new \Modules\Product\Transformers\ProductVariantTransformer($this->variant)),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CartItemTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('cart_id')->required(),
                Schema::string('product_id')->required(),
                Schema::string('variant_id')->required(),
                Schema::number('unit_price')->required(),
                Schema::integer('quantity')->required(),
                Schema::number('total_price')->required(),
                Schema::ref('#/components/schemas/ProductTransformer', 'product')->nullable(),
                Schema::ref('#/components/schemas/ProductVariantTransformer', 'variant')->nullable(),
            );
    }
} 