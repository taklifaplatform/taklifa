<?php

namespace Modules\Product\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Product\Transformers\ProductTransformer;

class ProductVariantTransformer extends JsonTransformer
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
            'price' => $this->price,
            'price_currency' => $this->price_currency,
            'product' => ProductTransformer::make($this->whenLoaded('product')),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductVariantTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::number('price')->required(),
                Schema::string('price_currency')->required(),
                Schema::ref('#/components/schemas/ProductTransformer', 'product')->nullable(),
            );
    }
}