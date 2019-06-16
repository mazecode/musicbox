<?php

namespace Mazecode\VueGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Mazecode\VueGenerator\Console\Commands\VueGeneratorCommand;

class VueGeneratorServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([VueGeneratorCommand::class]);
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [VueGeneratorCommand::class];
    }
}
