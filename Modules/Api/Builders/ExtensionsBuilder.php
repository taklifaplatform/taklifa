<?php

namespace Modules\Api\Builders;

use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use Illuminate\Support\Collection;
use Modules\Api\Attributes\Extension as ExtensionAttribute;
use Modules\Api\Factories\ExtensionFactory;

class ExtensionsBuilder
{
    public function build(BaseObject $baseObject, Collection $attributes): void
    {
        $attributes
            ->filter(static fn (object $attribute): bool => $attribute instanceof ExtensionAttribute)
            ->each(static function (ExtensionAttribute $extensionAttribute) use ($baseObject): void {
                if ($extensionAttribute->factory) {
                    /** @var ExtensionFactory $factory */
                    $factory = app($extensionAttribute->factory);
                    $key = $factory->key();
                    $value = $factory->value();
                } else {
                    $key = $extensionAttribute->key;
                    $value = $extensionAttribute->value;
                }

                $baseObject->x(
                    $key,
                    $value
                );
            });
    }
}
