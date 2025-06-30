<?php

namespace Modules\Company\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;

class CompanyUserTransformer extends JsonTransformer
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
            'username' => $this->username,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'latest_activity' => $this->latest_activity,
            'status' => $this->status,

            'avatar' => MediaTransformer::make($this->getFirstMedia('avatar')),
            'rating_stats' => $this->getRatingsScoreAndCount(),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CompanyUserTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('username')->required(),
                Schema::string('name')->required(),
                Schema::string('phone_number')->required(),
                Schema::string('email')->required(),
                Schema::string('latest_activity')->required(),
                Schema::string('status')->enum(['online', 'offline', 'busy'])->required(),

                Schema::ref('#/components/schemas/MediaTransformer', 'avatar'),

                Schema::object('rating_stats')
                    ->properties(
                        Schema::number('score')->required(),
                        Schema::integer('count')->required(),
                    )->required(),
            );
    }
}
