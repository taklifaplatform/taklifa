<?php

namespace Modules\Product\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;
use Modules\Company\Transformers\CompanyTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Product\Transformers\ProductVariantTransformer;
use Modules\Product\Transformers\ProductCategoryTransformer;
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

            'image' => MediaTransformer::make($this->getFirstMedia('images')),
            'images' => MediaTransformer::collection($this->getMedia('images')),

            'company' => CompanyTransformer::make($this->company),
            'category' => ProductCategoryTransformer::make($this->category),
            'category_id' => $this->category_id,
            'batch_product_id' => $this->batch_product_id,

            'created_with_ai' => $this->created_with_ai,

            'variant' => ProductVariantTransformer::make($this->variant),
            'is_available' => $this->is_available,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::string('batch_product_id')->nullable(),
                Schema::boolean('created_with_ai')->default(false),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company'),
                Schema::ref('#/components/schemas/MediaTransformer', 'image'),
                Schema::array('images')
                    ->items(Schema::ref('#/components/schemas/MediaTransformer'))
                    ->nullable(),
                Schema::ref('#/components/schemas/ProductVariantTransformer', 'variant'),
                Schema::ref('#/components/schemas/ProductCategoryTransformer', 'category'),
                Schema::boolean('is_available')->default(true),
                Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME),
                Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME),

            );
    }
}
