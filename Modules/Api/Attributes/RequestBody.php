<?php

namespace Modules\Api\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class RequestBody
{
    public $factory;

    public function __construct($factory)
    {
        $this->factory = (new $factory)->buildDocs();
    }
}
