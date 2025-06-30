<?php

namespace Modules\Company\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Geography\Transformers\LocationTransformer;

class CompanyBranchTransformer extends JsonTransformer
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
            'description' => $this->description,
            'contact_number' => $this->contact_number,

            'company_id' => $this->company_id,

            'location' => LocationTransformer::make($this->location),
            'location_id' => $this->location_id,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CompanyBranchTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->required(),
                Schema::string('contact_number')->required(),

                Schema::string('company_id')->required(),

                Schema::ref('#/components/schemas/LocationTransformer', 'location'),
                Schema::string('location_id')->required(),
            );
    }
}
