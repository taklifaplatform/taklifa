<?php

namespace Modules\User\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;

/**
 * Note keep this as simple user transformer, as it's public
 * no private date should be exposed here.
 */
class UserTransformer extends JsonTransformer
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
            'phone_number' => $this->phone_number,
            'about' => $this->about,
            'username' => $this->username,
            'latest_activity' => $this->latest_activity,
            'avatar' => MediaTransformer::make($this->getFirstMedia('avatar')),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('UserTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('username')->required(),
                Schema::string('name')->required(),
                Schema::string('phone_number')->required(),

                Schema::string('latest_activity')->required(),

                Schema::string('about')->required(),

                Schema::ref('#/components/schemas/MediaTransformer', 'avatar'),
            );
    }
}
