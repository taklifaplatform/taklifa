<?php

namespace Modules\User\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;
use Modules\Vehicle\Transformers\VehicleTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Geography\Transformers\LocationTransformer;
use Modules\Company\Transformers\SimpleCompanyTransformer;
use Modules\Geography\Transformers\LiveLocationTransformer;

class DriverTransformer extends JsonTransformer
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
            'working_hours_id' => $this->workingHour?->id,
            'latest_activity' => $this->latest_activity,
            'avatar' => MediaTransformer::make($this->getFirstMedia('avatar')),

            'companies' => SimpleCompanyTransformer::collection($this->companies),

            'location' => LocationTransformer::make($this->location),
            'live_location' => LiveLocationTransformer::make($this->latestLocation),
            'location_id' => $this->location_id,

            'urgency_service_provider' => $this->urgency_service_provider,
            'urgency_service_radius' => $this->urgency_service_radius,

            'rating_stats' => $this->getRatingsScoreAndCount(),

            'vehicle' => VehicleTransformer::make($this->vehicle),

            'roles' => UserSimpleRoleTransformer::collection($this->roles),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('DriverTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('username')->required(),
                Schema::string('name')->required(),
                Schema::string('phone_number')->required(),
                Schema::string('latest_activity')->required(),

                Schema::string('working_hours_id')->required(),

                Schema::string('about')->required(),

                Schema::ref('#/components/schemas/MediaTransformer', 'avatar'),

                Schema::array('companies')->items(
                    Schema::ref('#/components/schemas/SimpleCompanyTransformer'),
                ),

                Schema::ref('#/components/schemas/LocationTransformer', 'location'),
                Schema::ref('#/components/schemas/LiveLocationTransformer', 'live_location'),
                Schema::string('location_id')->required(),

                Schema::boolean('urgency_service_provider')->required(),
                Schema::integer('urgency_service_radius')->required(),

                Schema::object('rating_stats')
                    ->properties(
                        Schema::number('score')->required(),
                        Schema::integer('count')->required(),
                    )->required(),

                Schema::ref('#/components/schemas/VehicleTransformer', 'vehicle'),

                Schema::array('roles')->items(
                    Schema::ref('#/components/schemas/UserSimpleRoleTransformer'),
                ),
            );
    }
}
