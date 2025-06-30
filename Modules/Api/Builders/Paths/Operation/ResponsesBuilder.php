<?php

namespace Modules\Api\Builders\Paths\Operation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Modules\Api\Attributes\Response as ResponseAttribute;
use Modules\Api\Contracts\Reusable;
use Modules\Api\RouteInformation;

class ResponsesBuilder
{
    public function build(RouteInformation $routeInformation): array
    {
        return $routeInformation->actionAttributes
            ->filter(static fn (object $attribute): bool => $attribute instanceof ResponseAttribute)
            ->map(static function (ResponseAttribute $responseAttribute) {
                // dd($attribute->factory);
                $factory = $responseAttribute->factory;
                $response = $responseAttribute->factory;

                // dd($response->objectId);
                if ($factory instanceof Reusable) {
                    return Response::ref('#/components/responses/'.$response->objectId)
                        ->statusCode($responseAttribute->statusCode)
                        ->description($responseAttribute->description);
                }

                return $response;
            })
            ->values()
            ->toArray();
    }
}
