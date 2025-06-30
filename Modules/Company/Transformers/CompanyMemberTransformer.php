<?php

namespace Modules\Company\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class CompanyMemberTransformer extends JsonTransformer
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
            'role' => $this->role,
            'company_id' => $this->company_id,
            'user' => CompanyUserTransformer::make($this->user),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CompanyMemberTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('role')->required(),
                Schema::string('company_id')->required(),

                Schema::ref('#/components/schemas/CompanyUserTransformer', 'user'),
            );
    }
}
