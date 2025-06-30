<?php

namespace Modules\Api\Builders\Components;

use Modules\Api\Factories\SecuritySchemeFactory;
use Modules\Api\Generator;

class SecuritySchemesBuilder extends Builder
{
    public function build(string $collection = Generator::COLLECTION_DEFAULT): array
    {
        return $this->getAllClasses($collection)
            ->filter(static function ($class): bool {
                return is_a($class, SecuritySchemeFactory::class, true);
            })
            ->map(static function ($class): \GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme {
                /** @var SecuritySchemeFactory $instance */
                $instance = app($class);

                return $instance->build();
            })
            ->values()
            ->toArray();
    }
}
