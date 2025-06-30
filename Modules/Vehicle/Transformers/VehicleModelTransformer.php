<?php

namespace Modules\Vehicle\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;

class VehicleModelTransformer extends JsonTransformer
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
            'map_icon_width' => $this->map_icon_width,
            'map_icon_height' => $this->map_icon_height,
            'map_icon' => MediaTransformer::make($this->getFirstMedia('map_icon')),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('VehicleModelTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('map_icon_width')->required(),
                Schema::string('map_icon_height')->required(),
                Schema::ref('#/components/schemas/MediaTransformer', 'map_icon'),
            );
    }
}
