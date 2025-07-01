<?php

namespace Modules\Company\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;
use Modules\Geography\Transformers\LocationTransformer;

class CompanyTransformer extends JsonTransformer
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
            'about' => $this->about,

            'contact_number' => $this->owner?->phone_number,

            'branches' => CompanyBranchTransformer::collection($this->branches),

            'logo' => MediaTransformer::make($this->getFirstMedia('logo')),
            'location' => LocationTransformer::make($this->location),
            'location_id' => $this->location_id,
            'rating_stats' => $this->getRatingsScoreAndCount(),
        ];
    }


    public function schema(): Schema
    {
        return Schema::object('CompanyTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('about')->required(),
                Schema::string('contact_number')->required(),
                Schema::ref('#/components/schemas/MediaTransformer', 'logo'),
                Schema::string('location_id')->required(),

                Schema::object('rating_stats')
                    ->properties(
                        Schema::number('score')->required(),
                        Schema::integer('count')->required(),
                    )->required(),

                Schema::ref('#/components/schemas/CompanyBranchTransformer', 'branches'),
            );
    }
}
