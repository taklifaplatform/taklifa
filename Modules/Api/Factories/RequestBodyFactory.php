<?php

namespace Modules\Api\Factories;

use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Modules\Api\Concerns\Referencable;

abstract class RequestBodyFactory
{
    use Referencable;

    abstract public function build(): RequestBody;
}
