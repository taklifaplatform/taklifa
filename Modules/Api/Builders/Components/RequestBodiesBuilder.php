<?php

namespace Modules\Api\Builders\Components;

use Modules\Api\Generator;
use Modules\Core\Http\Requests\FormRequest;

class RequestBodiesBuilder extends Builder
{
    public function build(string $collection = Generator::COLLECTION_DEFAULT): array
    {
        return $this->getAllClasses($collection)
            ->filter(static function ($class): bool {
                return is_a($class, FormRequest::class, true);
            })
            ->map(static function ($class) {
                return (new $class)->buildDocs();
            })
            ->values()
            ->toArray();
    }
}
