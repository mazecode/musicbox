<?php

namespace Mazecode\MusicPlayer;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Mazecode\MusicPlayer\Console\Commands\MusicPlayerCommand;
use Mazecode\MusicPlayer\MusicPlayer;

class MusicPlayerServiceProvider extends ServiceProvider
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

        $this->app->alias(MusicPlayer::class, 'musicplayer');
    }

    private function registerFacade(): void
    {
        $this->app->singleton(MusicPlayer::class, function () {
            $musicPlayer = new MusicPlayer($this->app);

            return $musicPlayer;
        });
    }

    private function registerConfiguration(): void
    {
        $configPath = __DIR__.'/../config/musicplayer.php';
        $this->mergeConfigFrom($configPath, 'musicplayer');

        // Configuration
        $this->publishes([
            __DIR__.'/../config/musicplayer.php' => config_path('musicplayer.php'),
        ], 'musicplayer-config');
    }

    private function registerCommand(): void
    {
        $this->commands([MusicPlayerCommand::class]);
    }

    private function registerRoutes(): void
    {
        $config = $this->app['config']->get('musicplayer');

        if (is_bool($config['enabled']) && $config['enabled']) {
            $this->loadApiRouters();
            $this->loadWebRouters();
        }

        $ignoreRoutes = null;

        if (is_string($config['enabled'])) {
            $ignoreRoutes = explode(',', $config['enabled']);
        }

        if (is_array($ignoreRoutes)) {
            foreach ($ignoreRoutes as $k => $v) {
                if (Str::contains($v, 'api') && !Str::contains($v, 'api/*')) {
                    $this->loadApiRouters();
                } elseif (Str::contains($v, 'web') && !Str::contains($v, 'web/*')) {
                    $this->loadWebRouters();
                }
            }
        }
    }

    private function loadApiRouters()
    {
        $routeConfig = [
            'prefix' => $this->app['config']->get('musicplayer.route_prefix'),
            'domain' => $this->app['config']->get('musicplayer.route_domain'),
            'namespace' => 'Mazecode\MusicPlayer\Controllers\Api',
            'middleware' => ['api'],
        ];

        Route::prefix('api')->group(function () use ($routeConfig) {
            Route::group($routeConfig, function () {
                $this->loadRoutesFrom(__DIR__.'/routes/api.php');
            });
        });
    }

    private function loadWebRouters()
    {
        $routeConfig = [
            'prefix' => $this->app['config']->get('musicplayer.route_prefix'),
            'domain' => $this->app['config']->get('musicplayer.route_domain'),
            'namespace' => 'Mazecode\MusicPlayer\Controllers',
        ];

        Route::group($routeConfig, function () {
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        });

    }

    private function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
        ], 'musicplayer-migrations');
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'musicplayer');
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/mazecode/musicplayer'),
        ], 'musicplayer-views');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

//        $config = $this->app['config']->get('musicplayer');
//
//        // Enabled
//        if (is_bool($config['enabled']) && !$config['enabled']) {
//            return;
//        }

        Schema::defaultStringLength(191);

        $this->registerMigrations();
        $this->registerRoutes();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [MusicPlayerCommand::class, MusicPlayer::class];
    }
}
