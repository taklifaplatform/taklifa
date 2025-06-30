<?php

namespace Modules\Api\Builders\Paths\Operation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Modules\Api\Attributes\RequestBody as RequestBodyAttribute;
use Modules\Api\RouteInformation;

class RequestBodyBuilder
{
    public function build(RouteInformation $routeInformation): ?RequestBody
    {
        /** @var RequestBodyAttribute|null $requestBody */
        $requestBody = $routeInformation->actionAttributes->first(static fn (object $attribute): bool => $attribute instanceof RequestBodyAttribute);

        if ($requestBody) {
            // dd($requestBody->factory);
            // /** @var RequestBodyFactory $requestBodyFactory */
            // $requestBodyFactory = app($requestBody->factory);

            // $requestBody = $requestBodyFactory->build();

            // if ($requestBodyFactory instanceof Reusable) {
            //     return RequestBody::ref('#/components/requestBodies/'.$requestBody->objectId);
            // }
            return $requestBody->factory;
        }

        return $requestBody;
    }
}
