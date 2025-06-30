<?php

namespace Modules\Announcements\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\UserTransformer;
use Modules\Core\Transformers\MediaTransformer;
use Modules\Geography\Transformers\PriceTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class AnnouncementTransformer extends JsonTransformer
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

            'user' => UserTransformer::make($this->user),

            'title' => $this->title,
            'description' => $this->description,

            'images' => MediaTransformer::collection($this->getMedia('images')),

            'price' => $this->price,

            'city' => $this->city,

            'metadata' => $this->metadata,
            'metadata_fields' => $this->category?->metadata_fields ?? [],
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,

            'views_count' => $this->views_count ?? 0,
            'likes_count' => $this->likes_count ?? 0,
            'comments_count' => $this->comments_count ?? 0,

            'created_at' => $this->created_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('AnnouncementTransformer')
            ->properties(
                Schema::integer('id')->required(),

                Schema::ref('#/components/schemas/UserTransformer', 'user'),

                Schema::string('title')->required(),
                Schema::string('description')->required(),
                Schema::string('price')->required(),
                Schema::string('city')->required(),

                Schema::array('metadata')->required(),
                Schema::array('metadata_fields')->required(),

                Schema::integer('category_id')->required(),

                Schema::integer('sub_category_id')->required(),

                Schema::ref('#/components/schemas/MediaTransformer', 'images'),
                Schema::ref('#/components/schemas/PriceTransformer', 'price'),

                Schema::integer('views_count')->required(),
                Schema::integer('likes_count')->required(),
                Schema::integer('comments_count')->required(),

                Schema::string('created_at')->required(),
            );
    }
}
