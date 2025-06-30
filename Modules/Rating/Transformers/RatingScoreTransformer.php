<?php

namespace Modules\Rating\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class RatingScoreTransformer extends JsonTransformer
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
            'score' => $this->score,
            'type' => new RatingTypeTransformer($this->type),
            'created_at' => $this->created_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('RatingScoreTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::integer('score')->required(),
                Schema::ref('#/components/schemas/RatingTypeTransformer', 'type'),

                Schema::string('created_at')->required(),
            );
    }
}
