<?php

namespace Modules\Cart\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\Product\Transformers\ProductTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Product\Transformers\ProductVariantTransformer;

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
            'company_id' => $this->company_id,
            'product_id' => $this->product_id,
            'variant_id' => $this->variant_id,
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'product' => ProductTransformer::make($this->product),
            'variant' => ProductVariantTransformer::make($this->variant),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CartItemTransformer')
            ->properties(
                Schema::string('id')->required(),
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
