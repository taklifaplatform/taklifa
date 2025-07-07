<?php

namespace Modules\Product\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Company\Transformers\CompanyTransformer;
use Modules\Core\Transformers\JsonTransformer;

class ProductCategoryTransformer extends JsonTransformer
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
            'order' => $this->order,
            'company' => CompanyTransformer::make($this->company),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductCategoryTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::integer('order')->nullable(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company'),
            );
    }
}