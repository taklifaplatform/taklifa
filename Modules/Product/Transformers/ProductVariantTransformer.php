<?php

namespace Modules\Product\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Product\Entities\Product;

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
            'product_id' => ProductTransformer::make($this->product),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductVariantTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::number('price')->required(),
                Schema::string('price_currency')->required(),
                Schema::integer('product_id')->required(),
                Schema::ref('#/components/schemas/ProductTransformer', 'product'),
            );
    }
}