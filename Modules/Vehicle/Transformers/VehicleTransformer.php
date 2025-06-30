<?php

namespace Modules\Vehicle\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;

class VehicleTransformer extends JsonTransformer
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
            'internal_id' => $this->internal_id,
            'model_id' => $this->model_id,
            'color' => $this->color,
            'plate_number' => $this->plate_number,
            'vin_number' => $this->vin_number,
            'year' => $this->year,

            'image' => MediaTransformer::make($this->getFirstMedia('image')),
            'images' => MediaTransformer::collection($this->getMedia('images')),
            'model' => VehicleModelTransformer::make($this->model),
            'information' => new VehicleInformationTransformer($this->information),
            'fuel_information' => new VehicleFuelInformationTransformer($this->fuelInformation),
            'capacity_dimensions' => new VehicleCapacityDimensionsTransformer($this->capacityDimensions),
            'capacity_weight' => new VehicleCapacityWeightTransformer($this->capacityWeight),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('VehicleTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('internal_id')->required(),
                Schema::string('model_id')->required(),
                Schema::string('color')->required(),
                Schema::string('plate_number')->required(),
                Schema::string('vin_number')->required(),
                Schema::string('year')->required(),

                Schema::ref('#/components/schemas/MediaTransformer', 'image'),
                Schema::array('images')->items(
                    Schema::ref('#/components/schemas/MediaTransformer', 'images')
                ),

                Schema::ref('#/components/schemas/VehicleModelTransformer', 'model'),
                Schema::ref('#/components/schemas/VehicleInformationTransformer', 'information'),
                Schema::ref('#/components/schemas/VehicleFuelInformationTransformer', 'fuel_information'),
                Schema::ref('#/components/schemas/VehicleCapacityDimensionsTransformer', 'capacity_dimensions'),
                Schema::ref('#/components/schemas/VehicleCapacityWeightTransformer', 'capacity_weight'),
            );
    }
}
