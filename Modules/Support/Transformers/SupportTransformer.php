<?php

namespace Modules\Support\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class SupportTransformer extends JsonTransformer
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
            'category_id' => $this->category_id,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'subject' => $this->subject,
            'message' => $this->message,
            'status' => $this->status,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('SupportTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::integer('category_id')->nullable(),
                Schema::string('email')->required(),
                Schema::string('phone_number')->nullable(),
                Schema::string('subject')->required(),
                Schema::string('message')->required(),
                Schema::string('status'),
            );
    }
}
