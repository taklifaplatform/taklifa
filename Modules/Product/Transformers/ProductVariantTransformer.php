<?php

namespace Modules\Product\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

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
            'product_id' => $this->product_id,
            'product' => $this->whenLoaded('product', fn() => new ProductTransformer($this->product)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
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
                Schema::ref('#/components/schemas/ProductTransformer', 'product')->nullable(),
                Schema::string('created_at')->required(),
                Schema::string('updated_at')->required(),
            );
    }
} 