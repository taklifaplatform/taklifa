<?php

namespace Modules\Product\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ProductTransformer extends JsonTransformer
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
            'company_id' => $this->company_id,
            'company' => $this->whenLoaded('company', fn() => new \Modules\Company\Transformers\CompanyTransformer($this->company)),
            'variants' => $this->whenLoaded('variants', fn() => ProductVariantTransformer::collection($this->variants)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::integer('company_id')->required(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company')->nullable(),
                Schema::array('variants')->items(
                    Schema::ref('#/components/schemas/ProductVariantTransformer')
                )->nullable(),
                Schema::string('created_at')->required(),
                Schema::string('updated_at')->required(),
            );
    }
} 