<?php

namespace Modules\Geography\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class CountryTransformer extends JsonTransformer
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
            'name' => $this->name,
            'flag' => $this->flag,
            'dialling' => new CountryDialingTransformer($this->dialling),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CountryTransformer')
            ->properties(
                Schema::integer('id')->required()->example(1),
                Schema::string('name')->required(),
                Schema::string('flag')->required(),
                Schema::ref('#/components/schemas/CountryDialingTransformer', 'dialling'),
            );
    }
}
