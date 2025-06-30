<?php

namespace Modules\Services\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;
use Modules\User\Transformers\DriverTransformer;
use Modules\Geography\Transformers\PriceTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Company\Transformers\SimpleCompanyTransformer;

class ServiceTransformer extends JsonTransformer
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

            'company' => SimpleCompanyTransformer::make($this->company),
            'driver' => DriverTransformer::make($this->driver),

            'title' => $this->title,
            'description' => $this->description,

            'cover' => MediaTransformer::make($this->getFirstMedia('cover')),
            'images' => MediaTransformer::collection($this->getMedia('images')),

            'price' => PriceTransformer::make($this->prices()->first()),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ServiceTransformer')
            ->properties(
                Schema::integer('id')->required(),

                Schema::ref('#/components/schemas/SimpleCompanyTransformer', 'companies'),
                Schema::ref('#/components/schemas/DriverTransformer', 'driver'),

                Schema::string('title')->required(),
                Schema::string('description')->required(),

                Schema::ref('#/components/schemas/MediaTransformer', 'cover'),
                Schema::ref('#/components/schemas/MediaTransformer', 'images'),
                Schema::ref('#/components/schemas/PriceTransformer', 'price'),
            );
    }
}
