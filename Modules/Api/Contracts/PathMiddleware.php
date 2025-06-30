<?php

namespace Modules\Api\Contracts;

use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use Modules\Api\RouteInformation;

interface PathMiddleware
{
    public function before(RouteInformation $routeInformation): void;

    public function after(PathItem $pathItem): PathItem;
}
