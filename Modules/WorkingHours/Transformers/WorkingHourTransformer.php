<?php

namespace Modules\WorkingHours\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class WorkingHourTransformer extends JsonTransformer
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

            'monday' => (bool) $this->monday,
            'monday_start' => $this->monday_start,
            'monday_end' => $this->monday_end,

            'tuesday' => (bool) $this->tuesday,
            'tuesday_start' => $this->tuesday_start,
            'tuesday_end' => $this->tuesday_end,

            'wednesday' => (bool) $this->wednesday,
            'wednesday_start' => $this->wednesday_start,
            'wednesday_end' => $this->wednesday_end,

            'thursday' => (bool) $this->thursday,
            'thursday_start' => $this->thursday_start,
            'thursday_end' => $this->thursday_end,

            'friday' => (bool) $this->friday,
            'friday_start' => $this->friday_start,
            'friday_end' => $this->friday_end,

            'saturday' => (bool) $this->saturday,
            'saturday_start' => $this->saturday_start,
            'saturday_end' => $this->saturday_end,

            'sunday' => (bool) $this->sunday,
            'sunday_start' => $this->sunday_start,
            'sunday_end' => $this->sunday_end,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('WorkingHourTransformer')
            ->properties(
                Schema::string('id')->required(),

                Schema::boolean('monday')->required(),
                Schema::string('monday_start')->required(),
                Schema::string('monday_end')->required(),

                Schema::boolean('tuesday')->required(),
                Schema::string('tuesday_start')->required(),
                Schema::string('tuesday_end')->required(),

                Schema::boolean('wednesday')->required(),
                Schema::string('wednesday_start')->required(),
                Schema::string('wednesday_end')->required(),

                Schema::boolean('thursday')->required(),
                Schema::string('thursday_start')->required(),
                Schema::string('thursday_end')->required(),

                Schema::boolean('friday')->required(),
                Schema::string('friday_start')->required(),
                Schema::string('friday_end')->required(),

                Schema::boolean('saturday')->required(),
                Schema::string('saturday_start')->required(),
                Schema::string('saturday_end')->required(),

                Schema::boolean('sunday')->required(),
                Schema::string('sunday_start')->required(),
                Schema::string('sunday_end')->required(),
            );
    }
}
