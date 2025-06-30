<?php

namespace Modules\Api\Builders;

use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Modules\Api\Attributes;
use Modules\Api\Attributes\Collection as CollectionAttribute;
use Modules\Api\Builders\Paths\OperationsBuilder;
use Modules\Api\Contracts\PathMiddleware;
use Modules\Api\Generator;
use Modules\Api\RouteInformation;

class PathsBuilder
{
    protected OperationsBuilder $operationsBuilder;

    public function __construct(
        OperationsBuilder $operationsBuilder
    ) {
        $this->operationsBuilder = $operationsBuilder;
    }

    /**
     * @param  PathMiddleware[]  $middlewares
     */
    public function build(
        string $collection,
        array $middlewares
    ): array {
        // dd($this->routes());
        return $this->routes()
            ->filter(static function (RouteInformation $routeInformation) use ($collection): bool {
                /** @var CollectionAttribute|null $collectionAttribute */
                // api/ads/{id}
                if ($routeInformation->uri === '/api/ads/{ad}') {
                    // dd($routeInformation->controllerAttributes);
                }

                $collectionAttribute = collect()
                    ->merge($routeInformation->controllerAttributes)
                    ->merge($routeInformation->actionAttributes)
                    ->first(static fn (object $item): bool => $item instanceof CollectionAttribute);

                return
                    (! $collectionAttribute && $collection === Generator::COLLECTION_DEFAULT) ||
                    ($collectionAttribute && in_array($collection, $collectionAttribute->name, true));
            })
            ->map(static function (RouteInformation $routeInformation) use ($middlewares): RouteInformation {
                foreach ($middlewares as $middleware) {
                    app($middleware)->before($routeInformation);
                }

                return $routeInformation;
            })
            ->groupBy(static fn (RouteInformation $routeInformation): string => $routeInformation->uri)
            ->map(function (Collection $routes, $uri): PathItem {
                $pathItem = PathItem::create()->route($uri);

                $operations = $this->operationsBuilder->build($routes);

                return $pathItem->operations(...$operations);
            })
            ->map(static function (PathItem $pathItem) use ($middlewares) {
                foreach ($middlewares as $middleware) {
                    $pathItem = app($middleware)->after($pathItem);
                }

                return $pathItem;
            })
            ->values()
            ->toArray();
    }

    protected function routes(): Collection
    {
        /** @noinspection CollectFunctionInCollectionInspection */
        return collect(app(Router::class)->getRoutes())
            ->filter(static fn (Route $route): bool => $route->getActionName() !== 'Closure')
            ->map(static fn (Route $route): \Modules\Api\RouteInformation => RouteInformation::createFromRoute($route))
            ->filter(static function (RouteInformation $routeInformation): bool {
                $pathItem = $routeInformation->controllerAttributes
                    ->first(static fn (object $attribute): bool => $attribute instanceof Attributes\PathItem);

                $operation = $routeInformation->actionAttributes
                    ->first(static fn (object $attribute): bool => $attribute instanceof Attributes\Operation);

                return $pathItem && $operation;
            });
    }
}
