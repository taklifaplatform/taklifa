<?php

namespace Modules\Api\Builders;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use Illuminate\Support\Arr;

class TagsBuilder
{
    /**
     * @return Tag[]
     */
    public function build(array $config): array
    {
        return collect($config)
            ->map(static function (array $tag): Tag {
                return Tag::create()
                    ->name($tag['name'])
                    ->description(Arr::get($tag, 'description'));
            })
            ->toArray();
    }
}
