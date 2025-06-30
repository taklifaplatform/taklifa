<?php

namespace Modules\Api\Builders\Paths\Operation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Api\Attributes\Parameters;
use Modules\Api\Factories\ParametersFactory;
use Modules\Api\RouteInformation;
use Modules\Api\SchemaHelpers;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use ReflectionParameter;

class ParametersBuilder
{
    public function build(RouteInformation $routeInformation): array
    {
        $pathParameters = $this->buildPath($routeInformation);
        $attributedParameters = $this->buildAttribute($routeInformation);

        return $pathParameters->merge($attributedParameters)->toArray();
    }

    protected function buildPath(RouteInformation $routeInformation): Collection
    {
        return collect($routeInformation->parameters)
            ->map(static function (array $parameter) use ($routeInformation): ?\GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter {
                $schema = Schema::string();

                /** @var ReflectionParameter|null $reflectionParameter */
                $reflectionParameter = collect($routeInformation->actionParameters)
                    ->first(static fn (ReflectionParameter $reflectionParameter): bool => $reflectionParameter->name === $parameter['name']);

                if ($reflectionParameter) {
                    // The reflected param has no type, so ignore (should be defined in a ParametersFactory instead)
                    if ($reflectionParameter->getType() === null) {
                        return null;
                    }

                    $schema = SchemaHelpers::guessFromReflectionType($reflectionParameter->getType());
                }

                /** @var Param $description */
                $description = collect($routeInformation->actionDocBlock->getTagsByName('param'))
                    ->first(static fn (Param $param): bool => Str::snake($param->getVariableName()) === Str::snake($parameter['name']));

                return Parameter::path()->name($parameter['name'])
                    ->required()
                    ->description(optional(optional($description)->getDescription())->render())
                    ->schema($schema);
            })
            ->filter();
    }

    protected function buildAttribute(RouteInformation $routeInformation): Collection
    {
        /** @var Parameters|null $parameters */
        $parameters = $routeInformation->actionAttributes->first(static fn ($attribute): bool => $attribute instanceof Parameters, []);

        if ($parameters) {
            return collect($parameters->factory);
        }

        return collect($parameters);
    }
}
