<?php

namespace Modules\Api\Factories;

use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;

abstract class CallbackFactory
{
    abstract public function build(): PathItem;
}
