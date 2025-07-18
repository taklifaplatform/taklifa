<?php

namespace Modules\Product\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;
use Modules\User\Transformers\UserTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class BatchProductTransformer extends JsonTransformer
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
            'user_id' => $this->user_id,
            'count' => $this->count,
            'published_count' => $this->published_count,
            'user' => UserTransformer::make($this->user),
            'images' => MediaTransformer::collection($this->getMedia('images')),
            'products' => ProductTransformer::collection($this->whenLoaded('products')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('BatchProductTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('user_id')->required(),
                Schema::integer('count')->default(0),
                Schema::integer('published_count')->default(0),
                Schema::ref('#/components/schemas/UserTransformer', 'user'),
                Schema::array('images')
                    ->items(Schema::ref('#/components/schemas/MediaTransformer'))
                    ->nullable(),
                Schema::array('products')
                    ->items(Schema::ref('#/components/schemas/ProductTransformer'))
                    ->nullable(),
                Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME),
                Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME),
            );
    }
} 