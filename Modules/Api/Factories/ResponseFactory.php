<?php

namespace Modules\Api\Factories;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Modules\Api\Concerns\Referencable;

abstract class ResponseFactory
{
    use Referencable;

    abstract public function build(): Response;
}
