<?php

namespace Modules\Api\Builders\Paths;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Api\Attributes\Operation as OperationAttribute;
use Modules\Api\Builders\ExtensionsBuilder;
use Modules\Api\Builders\Paths\Operation\CallbacksBuilder;
use Modules\Api\Builders\Paths\Operation\ParametersBuilder;
use Modules\Api\Builders\Paths\Operation\RequestBodyBuilder;
use Modules\Api\Builders\Paths\Operation\ResponsesBuilder;
use Modules\Api\Builders\Paths\Operation\SecurityBuilder;
use Modules\Api\Factories\ServerFactory;
use Modules\Api\RouteInformation;
use phpDocumentor\Reflection\DocBlock;

class OperationsBuilder
{
    protected CallbacksBuilder $callbacksBuilder;

    protected ParametersBuilder $parametersBuilder;

    protected RequestBodyBuilder $requestBodyBuilder;

    protected ResponsesBuilder $responsesBuilder;

    protected ExtensionsBuilder $extensionsBuilder;

    protected SecurityBuilder $securityBuilder;

    public function __construct(
        CallbacksBuilder $callbacksBuilder,
        ParametersBuilder $parametersBuilder,
        RequestBodyBuilder $requestBodyBuilder,
        ResponsesBuilder $responsesBuilder,
        ExtensionsBuilder $extensionsBuilder,
        SecurityBuilder $securityBuilder
    ) {
        $this->callbacksBuilder = $callbacksBuilder;
        $this->parametersBuilder = $parametersBuilder;
        $this->requestBodyBuilder = $requestBodyBuilder;
        $this->responsesBuilder = $responsesBuilder;
        $this->extensionsBuilder = $extensionsBuilder;
        $this->securityBuilder = $securityBuilder;
    }

    /**
     * @param  RouteInformation[]|Collection  $routes
     *
     * @throws InvalidArgumentException
     */
    public function build(array|Collection $routes): array
    {
        $operations = [];

        /** @var RouteInformation[] $routes */
        foreach ($routes as $route) {
            /** @var OperationAttribute|null $operationAttribute */
            $operationAttribute = $route->actionAttributes
                ->first(static fn (object $attribute): bool => $attribute instanceof OperationAttribute);

            $operationId = optional($operationAttribute)->id;
            $tags = $operationAttribute->tags ?? [];
            $servers = collect($operationAttribute->servers)
                ->filter(static fn ($server): bool => app($server) instanceof ServerFactory)
                ->map(static fn ($server) => app($server)->build())
                ->toArray();

            $parameters = $this->parametersBuilder->build($route);
            $requestBody = $this->requestBodyBuilder->build($route);
            $responses = $this->responsesBuilder->build($route);
            $callbacks = $this->callbacksBuilder->build($route);
            $security = $this->securityBuilder->build($route);

            $operation = Operation::create()
                ->action(Str::lower($operationAttribute->method) ?: $route->method)
                ->tags(...$tags)
                ->deprecated($this->isDeprecated($route->actionDocBlock))
                ->description($route->actionDocBlock->getDescription()->render() !== '' ? $route->actionDocBlock->getDescription()->render() : null)
                ->summary($route->actionDocBlock->getSummary() !== '' ? $route->actionDocBlock->getSummary() : null)
                ->operationId($operationId)
                ->parameters(...$parameters)
                ->requestBody($requestBody)
                ->responses(...$responses)
                ->callbacks(...$callbacks)
                ->servers(...$servers);

            /** Not the cleanest code, we need to call notSecurity instead of security when our security has been turned off */
            if (count($security) === 1 && $security[0]->securityScheme === null) {
                $operation = $operation->noSecurity();
            } else {
                $operation = $operation->security(...$security);
            }

            $this->extensionsBuilder->build($operation, $route->actionAttributes);

            $operations[] = $operation;
        }

        return $operations;
    }

    protected function isDeprecated(?DocBlock $actionDocBlock): ?bool
    {
        if ($actionDocBlock === null) {
            return null;
        }

        $deprecatedTag = $actionDocBlock->getTagsByName('deprecated');

        if ($deprecatedTag !== []) {
            return true;
        }

        return null;
    }
}
