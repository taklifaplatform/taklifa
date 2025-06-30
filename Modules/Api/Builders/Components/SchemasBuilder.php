<?php

namespace Modules\Api\Builders\Components;

use Modules\Api\Factories\SecuritySchemeFactory;
use Modules\Api\Generator;
use Modules\Core\Transformers\JsonTransformer;

class SchemasBuilder extends Builder
{
    public function build(string $collection = Generator::COLLECTION_DEFAULT): array
    {
        $items = [];
        $classes = $this->getAllClasses($collection)
            ->filter(static function ($class): bool {
                return ! is_a($class, SecuritySchemeFactory::class, true);
            })->toArray();

        foreach ($classes as $class) {
            if (is_a($class, JsonTransformer::class, true)) {
                $items[] = (new $class(request()))->schema();
            } else {
                $classInstance = new $class;

                $schema = $classInstance->schema();
                if (count($classInstance->getSchemas())) {
                    foreach ($classInstance->getSchemas() as $_schema) {
                        $items[] = $_schema;
                    }
                }

                $items[] = $schema;
            }
        }

        return $items;
    }
}
