<?php

namespace Modules\Geography\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class CurrencyTransformer extends JsonTransformer
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
            'name' => $this->title,
            'code' => $this->iso_code,
            'units' => $this->units,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CurrencyTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),
                Schema::string('code')->required(),

                Schema::object('units')
                    ->properties(
                        Schema::object('major')
                            ->properties(
                                Schema::string('name')->required(),
                                Schema::string('symbol')->required(),
                            ),
                        Schema::object('minor')
                            ->properties(
                                Schema::string('name')->required(),
                                Schema::string('symbol')->required(),
                                Schema::number('majorValue')->required(),
                            ),
                    ),
            );
    }
}
