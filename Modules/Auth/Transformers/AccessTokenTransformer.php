<?php

namespace Modules\Auth\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class AccessTokenTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray(\Illuminate\Http\Request $request)
    {
        return parent::toArray($request);
    }

    public function schema(): Schema
    {
        return Schema::object('AccessTokenTransformer')
            ->properties(
                Schema::array('abilities')->items(Schema::string()->example('*')),
                Schema::string('expires_at'),
                Schema::string('tokenable_id')->required()->example(1),
                Schema::string('tokenable_type')->required()->example(\App\Models\User::class),
                Schema::string('updated_at')->required()->example('2023-04-17T16:18:30.000000Z'),
                Schema::string('created_at')->required()->example('2023-04-17T16:18:30.000000Z'),
                Schema::string('id')->required()->example('John Doe'),
            );
    }
}
