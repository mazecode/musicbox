<?php

namespace Mazecode\MusicPlayList;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Mazecode\MusicPlayList\Console\Commands\MusicPlayListCommand;
use Mazecode\MusicPlayList\MusicPlayList;

class MusicPlayListServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAllResources();
    }

    private function registerAllResources(): void
    {

        $this->registerFacade();
        $this->registerConfiguration();
        $this->registerCommand();
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerViews();

        $this->app->alias(MusicPlayList::class, 'MusicPlayList');
    }

    private function registerFacade(): void
    {
        $this->app->singleton(MusicPlayList::class, function () {
            $MusicPlayList = new MusicPlayList($this->app);

            return $MusicPlayList;
        });
    }

    private function registerConfiguration(): void
    {
        $configPath = __DIR__ . '/../config/musicplaylist.php';
        $this->mergeConfigFrom($configPath, 'musicplaylist');

        // Configuration
        $this->publishes([__DIR__ . '/../config/musicplaylist.php' => config_path( 'musicplaylist.php')], 'musicplaylist-config');
    }

    private function registerCommand(): void
    {
        $this->commands([MusicPlayListCommand::class]);
    }

    private function registerRoutes(): void
    {
        $config = $this->app['config']->get('musicplaylist');

        if (is_bool($config['enabled']) && $config['enabled']) {
            $this->loadApiRouters();
            $this->loadWebRouters();

            return;
        }

        $ignoreRoutes = (is_string($config['enabled'])) ? explode(',', $config['enabled']) : $config['enabled'];

        if (is_array($ignoreRoutes)) {
            foreach ($ignoreRoutes as $k => $v) {
                if (str_contains($v, 'api') && !str_contains($v, 'api/*')) {
                    $this->loadApiRouters();
                } elseif (str_contains($v, 'web') && !str_contains($v, 'web/*')) {
                    $this->loadWebRouters();
                }
            }
        }
    }

    private function loadApiRouters()
    {
        Route::prefix('api')->middleware('api')->group(function () {
            Route::group($this->getRouteConfig(), function () {
                Route::get('/', 'ApiController@index');

                // Route::middleware('auth:api')->group(function () {
                    $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
                // });
            });
        });
    }

    private function loadWebRouters()
    {
        Route::group($this->getRouteConfig(), function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        });
    }

    private function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->publishes([__DIR__ . '/database/migrations/' => database_path('migrations')], 'musicplaylist-migrations');
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'MusicPlayList');
        $this->publishes([__DIR__ . '/Views' => resource_path('views/vendor/mazecode/MusicPlayList')], 'musicplaylist-views');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $config = $this->app['config']->get('musicplaylist');

        // Enabled
        if (is_bool($config['enabled']) && !$config['enabled']) {
            return;
        }

        $this->registerMigrations();
        $this->registerRoutes();
        $this->app->register(SeedServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [MusicPlaylistCommand::class, MusicPlayList::class];
    }

    /**
     * Return min route config
     *
     * @return void
     */
    public function getRouteConfig()
    {
        return [
            'prefix' => $this->app['config']->get('musicplaylist.route_prefix'),
            'domain' => $this->app['config']->get('musicplaylist.route_domain'),
            'namespace' => 'Mazecode\MusicPlayList\Controllers',
        ];
    }
}
