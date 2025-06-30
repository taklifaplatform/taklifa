<?php

namespace Modules\Api\Attributes;

use Attribute;
use InvalidArgumentException;
use Modules\Api\Factories\SecuritySchemeFactory;

#[Attribute(Attribute::TARGET_METHOD)]
class Operation
{
    public ?string $id;

    /** @var array<string> */
    public array $tags;

    public $security;

    public ?string $method;

    public ?array $servers;

    /**
     * @param  \Modules\Api\Factories\SecuritySchemeFactory|string|null  $security
     *
     * @throws InvalidArgumentException
     */
    public function __construct(?string $id = null, array $tags = [], $security = null, ?string $method = null, ?array $servers = null)
    {
        $this->id = $id;
        $this->tags = $tags;
        $this->method = $method;
        $this->servers = $servers;

        if ($security === '') {
            //user wants to turn off security on this operation
            $this->security = $security;

            return;
        }

        if ($security) {
            $this->security = new $security;
            if (! $this->security instanceof \Modules\Api\Factories\SecuritySchemeFactory) {
                throw new InvalidArgumentException(
                    sprintf('Security class is either not declared or is not an instance of %s', SecuritySchemeFactory::class)
                );
            }
        }
    }
}
