<?php

namespace Modules\Analytics\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\UserTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class UserAnalyticTransformer extends JsonTransformer
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
            'viewer' => UserTransformer::make($this->viewer),
            'action_type' => $this->action_type,
            'count' => $this->count,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('UserAnalyticTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::ref('#/components/schemas/UserTransformer', 'user'),
                Schema::ref('#/components/schemas/UserTransformer', 'viewer'),
                Schema::string('action_type')->required(),
                Schema::integer('count')->required(),
            );
    }
}
