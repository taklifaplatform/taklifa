<?php

namespace Modules\Notification\Transformers;

use App\Models\User;
use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\UserTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class NotificationTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $sender = null;

        if (array_key_exists('from_user_id', $this->data)) {
            $sender = new UserTransformer(
                User::find($this->data['from_user_id'])
            );
        }

        return [
            'id' => $this->id,
            'data' => $this->data,
            'read_at' => $this->read_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'sender' => $sender,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('NotificationTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::object('data')->properties(
                    Schema::string('filter')->required(),
                    Schema::string('from_user_id')->required(),
                    Schema::string('type')->required(),
                    Schema::string('title')->required(),
                    Schema::string('description')->required(),
                    Schema::string('model_type')->required(),
                    Schema::string('model_id')->required(),
                ),
                Schema::string('read_at')->required(),
                Schema::string('created_at')->required(),
                Schema::string('updated_at')->required(),
                Schema::ref('#/components/schemas/UserTransformer', 'sender'),
            );
    }
}
