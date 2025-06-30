<?php

namespace Modules\Api\Builders\Paths\Operation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement;
use Modules\Api\Attributes\Operation as OperationAttribute;
use Modules\Api\RouteInformation;

class SecurityBuilder
{
    public function build(RouteInformation $routeInformation): array
    {
        return $routeInformation->actionAttributes
            ->filter(static fn (object $attribute): bool => $attribute instanceof OperationAttribute)
            ->filter(static fn (OperationAttribute $operationAttribute): bool => isset($operationAttribute->security))
            ->map(static function (OperationAttribute $operationAttribute): SecurityRequirement {
                // return a null scheme if the security is set to ''
                if ($operationAttribute->security === '') {
                    return SecurityRequirement::create()->securityScheme(null);
                }

                // dd($attribute->security->build());
                $security = $operationAttribute->security;
                $scheme = $security->build();

                return SecurityRequirement::create()->securityScheme($scheme);
            })
            ->values()
            ->toArray();
    }
}
