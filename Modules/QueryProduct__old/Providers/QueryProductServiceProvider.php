<?php

namespace Modules\QueryProduct\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class QueryProductServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('QueryProduct', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('QueryProduct', 'Config/config.php') => config_path('queryproduct.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('QueryProduct', 'Config/config.php'), 'queryproduct'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/queryproduct');

        $sourcePath = module_path('QueryProduct', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/queryproduct';
        }, \Config::get('view.paths')), [$sourcePath]), 'queryproduct');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/queryproduct');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'queryproduct');
        } else {
            $this->loadTranslationsFrom(module_path('QueryProduct', 'Resources/lang'), 'queryproduct');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('QueryProduct', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
