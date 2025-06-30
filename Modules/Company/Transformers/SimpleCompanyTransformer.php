<?php

namespace Modules\Company\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;

class SimpleCompanyTransformer extends JsonTransformer
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
            'is_verified' => $this->is_verified,
            'verified_at' => $this->verified_at,
            'verification_status' => $this->verification_status,
            'logo' => MediaTransformer::make($this->getFirstMedia('logo')),
            'contact_number' => $this->owner?->phone_number,

            'branches' => CompanyBranchTransformer::collection($this->branches),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('SimpleCompanyTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::boolean('is_verified')->required(),
                Schema::string('verified_at')->required(),
                Schema::string('verification_status')->required(),

                Schema::ref('#/components/schemas/MediaTransformer', 'logo'),
                Schema::string('contact_number')->required(),

                Schema::ref('#/components/schemas/CompanyBranchTransformer', 'branches'),
            );
    }
}
