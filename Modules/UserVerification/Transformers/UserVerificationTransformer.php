<?php

namespace Modules\UserVerification\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;
use Modules\Geography\Transformers\LocationTransformer;

class UserVerificationTransformer extends JsonTransformer
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
            'birth_date' => $this->birth_date,
            'nationality_id' => $this->nationality_id,
            'driving_license_number' => $this->driving_license_number,

            'location' => LocationTransformer::make($this->location),

            'identity_card' => MediaTransformer::make($this->getFirstMedia('identity_card')),
            'driving_license_card' => MediaTransformer::make($this->getFirstMedia('driving_license_card')),
            'assurance_card' => MediaTransformer::make($this->getFirstMedia('assurance_card')),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('UserVerificationTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),
                Schema::string('birth_date')->required(),
                Schema::integer('nationality_id')->required(),
                Schema::string('driving_license_number')->required(),

                Schema::ref('#/components/schemas/LocationTransformer', 'location'),
                Schema::ref('#/components/schemas/MediaTransformer', 'identity_card'),
                Schema::ref('#/components/schemas/MediaTransformer', 'driving_license_card'),
                Schema::ref('#/components/schemas/MediaTransformer', 'assurance_card'),
            );
    }
}
