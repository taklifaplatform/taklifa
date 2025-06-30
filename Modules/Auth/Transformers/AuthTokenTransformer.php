<?php

namespace Modules\Auth\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\AuthenticatedUserTransformer;

class AuthTokenTransformer extends JsonTransformer
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
            'plainTextToken' => $this->plainTextToken,
            'accessToken' => new AccessTokenTransformer($this->accessToken),
            'user' => new AuthenticatedUserTransformer($this->accessToken->tokenable),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('AuthTokenTransformer')
            ->properties(
                Schema::string('plainTextToken')->required()->example('5|an0l3xfOj4xcpZxE5ZMrorUsgdocGp5BHkZV1t1f'),
                Schema::ref('#/components/schemas/AccessTokenTransformer', 'accessToken'),
                Schema::ref('#/components/schemas/AuthenticatedUserTransformer', 'user'),
            );
    }
}
