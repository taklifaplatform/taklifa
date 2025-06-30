<?php

namespace Modules\Api\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Modules\Api\Builders\ComponentsBuilder;
use Modules\Api\Builders\InfoBuilder;
use Modules\Api\Builders\PathsBuilder;
use Modules\Api\Builders\ServersBuilder;
use Modules\Api\Builders\TagsBuilder;
use Modules\Api\Console;
use Modules\Api\Console\GenerateCommand;
use Modules\Api\Generator;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $moduleName = 'Api';

    /**
     * @var string
     */
    protected $moduleNameLower = 'api';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->registerConfig();

        $this->app->singleton(Generator::class, static function (Application $application): Generator {
            $config = config('api');

            return new Generator(
                $config,
                $application->make(InfoBuilder::class),
                $application->make(ServersBuilder::class),
                $application->make(TagsBuilder::class),
                $application->make(PathsBuilder::class),
                $application->make(ComponentsBuilder::class)
            );
        });

        $this->commands([
            GenerateCommand::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\CallbackFactoryMakeCommand::class,
                Console\ExtensionFactoryMakeCommand::class,
                Console\ParametersFactoryMakeCommand::class,
                Console\RequestBodyFactoryMakeCommand::class,
                Console\ResponseFactoryMakeCommand::class,
                Console\SchemaFactoryMakeCommand::class,
                Console\SecuritySchemeFactoryMakeCommand::class,
            ]);
        }
    }

    public function boot(): void
    {
        $this->registerViews();

    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower.'.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath,
        ], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }
}
