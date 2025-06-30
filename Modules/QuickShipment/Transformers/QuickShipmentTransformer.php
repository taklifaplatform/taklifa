<?php

namespace Modules\QuickShipment\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\UserTransformer;
use Modules\Core\Transformers\MediaTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\User\Transformers\DriverTransformer;

class QuickShipmentTransformer extends JsonTransformer
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
            'notes' => $this->notes,
            'price' => $this->price,
            'date' => $this->date,
            'is_accepted' => $this->is_accepted,

            'medias' => MediaTransformer::collection($this->getMedia('medias')),
            'user' => UserTransformer::make($this->user),
            'driver' => DriverTransformer::make($this->driver),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('QuickShipmentTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('notes')->nullable(),
                Schema::string('price')->nullable(),
                Schema::string('date')->nullable(),

                Schema::boolean('is_accepted')->default(false),

                Schema::ref('#/components/schemas/UserTransformer', 'user'),
                Schema::ref('#/components/schemas/DriverTransformer', 'driver'),

                Schema::array('medias')->items(
                    Schema::ref('#/components/schemas/MediaTransformer', 'media')
                ),

                Schema::string('created_at')->nullable(),
                Schema::string('updated_at')->nullable(),
            );
    }
}
