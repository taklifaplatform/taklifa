<?php

namespace Modules\Api\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Parameters
{
    public $factory;

    public function __construct($factory)
    {
        $class = new $factory;
        // check if $class has parametersSchema method
        if (method_exists($class, 'parametersSchema')) {
            $this->factory = (new $factory)->parametersSchema();
        }
    }
}
