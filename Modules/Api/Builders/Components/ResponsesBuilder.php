<?php

namespace Modules\Api\Builders\Components;

use Modules\Api\Generator;
use Modules\Core\Transformers\JsonTransformer;

class ResponsesBuilder extends Builder
{
    public function build(string $collection = Generator::COLLECTION_DEFAULT): array
    {
        return $this->getAllClasses($collection)
            ->filter(static function ($class): bool {
                return is_a($class, JsonTransformer::class, true);
            })
            ->map(static function ($class) {
                return (new $class(request()))->buildDocs();
            })
            ->values()
            ->toArray();
    }
}
