<?php

namespace Modules\Api\Builders\Paths\Operation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use Modules\Api\Attributes\Callback as CallbackAttribute;
use Modules\Api\Contracts\Reusable;
use Modules\Api\RouteInformation;

class CallbacksBuilder
{
    public function build(RouteInformation $routeInformation): array
    {
        return $routeInformation->actionAttributes
            ->filter(static fn (object $attribute): bool => $attribute instanceof CallbackAttribute)
            ->map(static function (CallbackAttribute $callbackAttribute) {
                $factory = app($callbackAttribute->factory);
                $pathItem = $factory->build();

                if ($factory instanceof Reusable) {
                    return PathItem::ref('#/components/callbacks/'.$pathItem->objectId);
                }

                return $pathItem;
            })
            ->values()
            ->toArray();
    }
}
