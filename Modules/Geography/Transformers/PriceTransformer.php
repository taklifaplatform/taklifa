<?php

namespace Modules\Geography\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class PriceTransformer extends JsonTransformer
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
            'currency_id' => $this->currency_id,
            'currency' => new CurrencyTransformer($this->currency),
            'value' => $this->value,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('PriceTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::integer('currency_id')->required(),
                Schema::ref('#/components/schemas/CurrencyTransformer', 'currency'),
                Schema::number('value')->required(),
            );
    }
}
