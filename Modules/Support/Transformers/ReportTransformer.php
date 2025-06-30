<?php

namespace Modules\Support\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ReportTransformer extends JsonTransformer
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
            'reason_id' => $this->reason_id,
            'message' => $this->message,
            'status' => $this->status,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ReportTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::integer('reason_id')->required(),
                Schema::string('message')->required(),
                Schema::string('status'),
            );
    }
}
