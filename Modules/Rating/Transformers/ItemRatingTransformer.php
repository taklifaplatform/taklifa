<?php

namespace Modules\Rating\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\UserTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class ItemRatingTransformer extends JsonTransformer
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
            'comment' => $this->comment,
            'score' => $this->score,
            'user' => new UserTransformer($this->user),

            'scores' => RatingScoreTransformer::collection($this->scores),

            'created_at' => $this->created_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ItemRatingTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('comment')->required(),
                Schema::integer('score')->required(),

                Schema::ref('#/components/schemas/UserTransformer', 'user'),

                Schema::array('scores')->items(
                    Schema::ref('#/components/schemas/RatingScoreTransformer')
                ),
                Schema::string('created_at')->required(),
            );
    }
}
