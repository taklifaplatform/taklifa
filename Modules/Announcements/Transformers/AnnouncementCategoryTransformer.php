<?php

namespace Modules\Announcements\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class AnnouncementCategoryTransformer extends JsonTransformer
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
            'metadata_fields' => $this->metadata_fields,

            'sub_categories' => AnnouncementCategoryTransformer::collection($this->enabledSubCategories),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('AnnouncementCategoryTransformer')
            ->properties(
                Schema::integer('id')->required(),


                Schema::string('name')->required(),

                Schema::array('metadata_fields')->items(
                    Schema::object('AnnouncementCategoryTransformer')
                        ->properties(
                            Schema::string('key')->required(),
                            Schema::string('name_ar')->required(),
                            Schema::string('name_en')->required(),
                            Schema::string('placeholder_ar')->required(),
                            Schema::string('placeholder_en')->required(),
                            Schema::string('type')->required(),
                        )
                ),

                Schema::array('sub_categories')->items(
                    Schema::object('AnnouncementCategoryTransformer')
                        ->properties(
                            Schema::integer('id')->required(),
                            Schema::string('name')->required(),
                        )
                ),
            );
    }
}
