<?php

namespace Modules\Api\Builders\Components;

use Modules\Api\Factories\CallbackFactory;
use Modules\Api\Generator;
use Modules\Core\Http\Requests\FormRequest;

class CallbacksBuilder extends Builder
{
    public function build(string $collection = Generator::COLLECTION_DEFAULT): array
    {
        return $this->getAllClasses($collection)
            ->filter(static function ($class): bool {
                // dd($class);
                return
                    is_a($class, CallbackFactory::class, true) &&
                    is_a($class, FormRequest::class, true);
            })
            ->map(static function ($class): \GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem {
                /** @var CallbackFactory $instance */
                $instance = app($class);

                return $instance->build();
            })
            ->values()
            ->toArray();
    }
}
