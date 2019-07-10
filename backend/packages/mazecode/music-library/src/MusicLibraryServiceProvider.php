<?php

namespace Mazecode\MusicLibrary;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Mazecode\MusicLibrary\Console\Commands\MusicLibraryCommand;
use Mazecode\MusicLibrary\MusicLibrary;

class MusicLibraryServiceProvider extends ServiceProvider
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

		$this->app->alias(MusicLibrary::class, 'MusicLibrary');
	}

	private function registerFacade(): void
	{
		$this->app->singleton(MusicLibrary::class, function () {
			$MusicLibrary = new MusicLibrary($this->app);

			return $MusicLibrary;
		});
	}

	private function registerConfiguration(): void
	{
		$configPath = __DIR__ . '/../config/musiclibrary.php';
		$this->mergeConfigFrom($configPath, 'musiclibrary');

		// Configuration
		$this->publishes([__DIR__ . '/../config/musiclibrary.php' => config_path('musiclibrary.php')], 'musiclibrary-config');
	}

	private function registerCommand(): void
	{
		$this->commands([MusicLibraryCommand::class]);
	}

	private function registerRoutes(): void
	{
		$config = $this->app['config']->get('musiclibrary');

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
		$this->publishes([__DIR__ . '/database/migrations/' => database_path('migrations')], 'musiclibrary-migrations');
	}

	private function registerViews(): void
	{
		$this->loadViewsFrom(__DIR__ . '/Views', 'MusicLibrary');
		$this->publishes([__DIR__ . '/Views' => resource_path('views/vendor/mazecode/music-library')], 'musiclibrary-views');
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		Schema::defaultStringLength(191);

		$config = $this->app['config']->get('musiclibrary');

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
		return [MusicLibraryCommand::class, MusicLibrary::class];
	}

	/**
	 * Return min route config
	 *
	 * @return void
	 */
	public function getRouteConfig()
	{
		return [
			'prefix' => $this->app['config']->get('musiclibrary.route_prefix'),
			'domain' => $this->app['config']->get('musiclibrary.route_domain'),
			'namespace' => 'Mazecode\MusicLibrary\Controllers',
		];
	}
}
