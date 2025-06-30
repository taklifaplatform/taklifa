<?php

namespace Modules\Geography\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class CountryDialingTransformer extends JsonTransformer
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
            'prefix' => $this->prefix,
            'mask' => $this->mask,
            'mak_char' => $this->mak_char,
            'dial_code' => $this->dial_code,
            'international_prefix' => $this->international_prefix,
            'national_destination_code_lengths' => $this->national_destination_code_lengths,
            'national_number_lengths' => $this->national_number_lengths,
            'national_prefix' => $this->national_prefix,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CountryDialingTransformer')
            ->properties(
                Schema::string('prefix'),
                Schema::string('mask'),
                Schema::string('mak_char'),
                Schema::string('dial_code'),
                Schema::string('international_prefix')->example('00'),
                Schema::array('national_destination_code_lengths')->items(Schema::string()->example('2')),
                Schema::array('national_number_lengths')->items(Schema::string()->example('7')),
                Schema::string('national_prefix')->example('null'),
            );
    }
}
