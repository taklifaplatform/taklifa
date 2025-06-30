<?php

namespace Modules\Shipment\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;

class ShipmentItemTransformer extends JsonTransformer
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
            'medias' => MediaTransformer::collection($this->getMedia('medias')),

            'notes' => $this->notes,
            'dim_width' => $this->dim_width,
            'dim_height' => $this->dim_height,
            'dim_length' => $this->dim_length,
            'cap_unit' => $this->cap_unit,
            'cap_weight' => $this->cap_weight,
            'content' => $this->content,
            'content_value' => $this->content_value,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ShipmentItemTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::array('medias')->items(
                    Schema::ref('#/components/schemas/MediaTransformer', 'medias')
                ),

                Schema::string('notes')->nullable(),
                Schema::number('dim_width')->nullable(),
                Schema::number('dim_height')->nullable(),
                Schema::number('dim_length')->nullable(),
                Schema::string('cap_unit')->nullable(),
                Schema::number('cap_weight')->nullable(),
                Schema::string('content')->nullable(),
                Schema::number('content_value')->nullable(),
            );
    }
}
