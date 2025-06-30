<?php

namespace Modules\Api;

use GoldSpecDigital\ObjectOrientedOAS\OpenApi;
use Illuminate\Support\Arr;
use Modules\Api\Builders\ComponentsBuilder;
use Modules\Api\Builders\InfoBuilder;
use Modules\Api\Builders\PathsBuilder;
use Modules\Api\Builders\ServersBuilder;
use Modules\Api\Builders\TagsBuilder;

class Generator
{
    public string $version = OpenApi::OPENAPI_3_0_2;

    public const COLLECTION_DEFAULT = 'default';

    protected array $config;

    protected InfoBuilder $infoBuilder;

    protected ServersBuilder $serversBuilder;

    protected TagsBuilder $tagsBuilder;

    protected PathsBuilder $pathsBuilder;

    protected ComponentsBuilder $componentsBuilder;

    public function __construct(
        array $config,
        InfoBuilder $infoBuilder,
        ServersBuilder $serversBuilder,
        TagsBuilder $tagsBuilder,
        PathsBuilder $pathsBuilder,
        ComponentsBuilder $componentsBuilder
    ) {
        $this->config = $config;
        $this->infoBuilder = $infoBuilder;
        $this->serversBuilder = $serversBuilder;
        $this->tagsBuilder = $tagsBuilder;
        $this->pathsBuilder = $pathsBuilder;
        $this->componentsBuilder = $componentsBuilder;
    }

    public function generate(string $collection = self::COLLECTION_DEFAULT): OpenApi
    {
        $middlewares = Arr::get($this->config, 'collections.'.$collection.'.middlewares');

        $info = $this->infoBuilder->build(Arr::get($this->config, 'collections.'.$collection.'.info', []));
        $servers = $this->serversBuilder->build(Arr::get($this->config, 'collections.'.$collection.'.servers', []));
        $tags = $this->tagsBuilder->build(Arr::get($this->config, 'collections.'.$collection.'.tags', []));
        $paths = $this->pathsBuilder->build($collection, Arr::get($middlewares, 'paths', []));
        $components = $this->componentsBuilder->build($collection, Arr::get($middlewares, 'components', []));
        $extensions = Arr::get($this->config, 'collections.'.$collection.'.extensions', []);

        $openApi = OpenApi::create()
            ->openapi(OpenApi::OPENAPI_3_0_2)
            ->info($info)
            ->servers(...$servers)
            ->paths(...$paths)
            ->components($components)
            ->security(...Arr::get($this->config, 'collections.'.$collection.'.security', []))
            ->tags(...$tags);

        foreach ($extensions as $key => $value) {
            $openApi = $openApi->x($key, $value);
        }

        return $openApi;
    }
}
