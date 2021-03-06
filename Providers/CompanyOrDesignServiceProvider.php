<?php

namespace Modules\CompanyOrDesign\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class CompanyOrDesignServiceProvider extends ServiceProvider
{
        /**
     * @var string $moduleName
     */
        protected $moduleName = 'CompanyOrDesign';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'companyordesign';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('CompanyOrDesign', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(ObserverServiceProvider::class);
        $this->app->register(RelationshipServiceProvider::class);

    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );



        /*$this->publishes([
            module_path('CompanyOrDesign', 'Config/config.php') => config_path('companyordesign.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('CompanyOrDesign', 'Config/config.php'), 'companyordesign'
        );*/
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);



        /*$viewPath = resource_path('views/modules/companyordesign');

        $sourcePath = module_path('CompanyOrDesign', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/companyordesign';
        }, \Config::get('view.paths')), [$sourcePath]), 'companyordesign');*/
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/companyordesign');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'companyordesign');
        } else {
            $this->loadTranslationsFrom(module_path('CompanyOrDesign', 'Resources/lang'), 'companyordesign');
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
        app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
    }

        /*if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('CompanyOrDesign', 'Database/factories'));
        }*/
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
