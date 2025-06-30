<?php

namespace Modules\Api\Factories;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use Modules\Api\Concerns\Referencable;

abstract class ParametersFactory
{
    use Referencable;

    /**
     * @return Parameter[]
     */
    abstract public function build(): array;
}
