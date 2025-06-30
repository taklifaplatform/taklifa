<?php

namespace Modules\Api\Builders\Components;

use Illuminate\Support\Collection;
use Modules\Api\Attributes\Collection as CollectionAttribute;
use Modules\Api\ClassMapGenerator;
use Modules\Api\Generator;
use Nwidart\Modules\Facades\Module;
use ReflectionClass;

abstract class Builder
{
    protected array $directories = [];

    public function __construct()
    {
        $directories = [
            module_path('Auth', 'OpenApi/SecuritySchemes'),
        ];
        foreach (Module::all() as $module) {
            $directories[] = module_path($module->getName(), 'Http/Requests');
            $directories[] = module_path($module->getName(), 'Transformers');
            $directories[] = module_path($module->getName(), 'Transformers');
        }

        $this->directories = $directories;
    }

    protected function getAllClasses(string $collection): Collection
    {

        return collect($this->directories)
            ->map(static function (string $directory): array {
                $map = ClassMapGenerator::createMap($directory);

                return array_keys($map);
            })
            ->flatten()
            ->filter(static function (string $class) use ($collection): bool {
                $reflectionClass = new ReflectionClass($class);
                $collectionAttributes = $reflectionClass->getAttributes(CollectionAttribute::class);
                if ($collectionAttributes === [] && $collection === Generator::COLLECTION_DEFAULT) {
                    return true;
                }

                if ($collectionAttributes === []) {
                    return false;
                }

                /** @var CollectionAttribute $collectionAttribute */
                $collectionAttribute = $collectionAttributes[0]->newInstance();

                return
                    $collectionAttribute->name === ['*'] ||
                    in_array($collection, $collectionAttribute->name ?? [], true);
            });
    }
}
