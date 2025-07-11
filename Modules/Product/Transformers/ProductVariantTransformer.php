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

            'type' => $this->type,
            'type_unit' => $this->type_unit,
            'type_value' => $this->type_value,

            'stock' => $this->stock,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductVariantTransformer')
            ->properties(
                Schema::string('id')->required(),

                /**
                 * unit: 1 (count) =>
                 * weight: [g, kg, lb, oz]
                 * size: [cm, m, in, ft]
                 */
                Schema::string('type')->enum('type', ['count', 'weight', 'size']),
                // unit size is 1 (count)
                Schema::string('type_unit')->enum('type', [
                    'g', 'kg', 'lb', 'oz',
                    'cm', 'm', 'in', 'ft',
                ]),
                Schema::number('type_value')->nullable(),

                Schema::number('stock')->nullable(),

                Schema::number('price')->required(),
                Schema::string('price_currency')->default('SAR')->required(),


            );
    }
}