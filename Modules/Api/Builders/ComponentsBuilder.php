<?php

namespace Modules\Api\Builders;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Components;
use Modules\Api\Builders\Components\CallbacksBuilder;
use Modules\Api\Builders\Components\RequestBodiesBuilder;
use Modules\Api\Builders\Components\ResponsesBuilder;
use Modules\Api\Builders\Components\SchemasBuilder;
use Modules\Api\Builders\Components\SecuritySchemesBuilder;
use Modules\Api\Generator;

class ComponentsBuilder
{
    protected CallbacksBuilder $callbacksBuilder;

    protected RequestBodiesBuilder $requestBodiesBuilder;

    protected ResponsesBuilder $responsesBuilder;

    protected SchemasBuilder $schemasBuilder;

    protected SecuritySchemesBuilder $securitySchemesBuilder;

    public function __construct(
        CallbacksBuilder $callbacksBuilder,
        RequestBodiesBuilder $requestBodiesBuilder,
        ResponsesBuilder $responsesBuilder,
        SchemasBuilder $schemasBuilder,
        SecuritySchemesBuilder $securitySchemesBuilder
    ) {
        $this->callbacksBuilder = $callbacksBuilder;
        $this->requestBodiesBuilder = $requestBodiesBuilder;
        $this->responsesBuilder = $responsesBuilder;
        $this->schemasBuilder = $schemasBuilder;
        $this->securitySchemesBuilder = $securitySchemesBuilder;
    }

    public function build(
        string $collection = Generator::COLLECTION_DEFAULT,
        array $middlewares = []
    ): ?Components {
        $callbacks = $this->callbacksBuilder->build($collection);
        $requestBodies = $this->requestBodiesBuilder->build($collection);
        $responses = $this->responsesBuilder->build($collection);
        $schemas = $this->schemasBuilder->build($collection);
        $securitySchemes = $this->securitySchemesBuilder->build($collection);

        $components = Components::create();

        $hasAnyObjects = false;

        if ($callbacks !== []) {
            $hasAnyObjects = true;

            $components = $components->callbacks(...$callbacks);
        }

        if ($requestBodies !== []) {
            $hasAnyObjects = true;

            $components = $components->requestBodies(...$requestBodies);
        }

        if ($responses !== []) {
            $hasAnyObjects = true;
            $components = $components->responses(...$responses);
        }

        if ($schemas !== []) {
            $hasAnyObjects = true;
            $components = $components->schemas(...$schemas);
        }

        if ($securitySchemes !== []) {
            $hasAnyObjects = true;
            $components = $components->securitySchemes(...$securitySchemes);
        }

        if (! $hasAnyObjects) {
            return null;
        }

        foreach ($middlewares as $middleware) {
            app($middleware)->after($components);
        }

        return $components;
    }
}
