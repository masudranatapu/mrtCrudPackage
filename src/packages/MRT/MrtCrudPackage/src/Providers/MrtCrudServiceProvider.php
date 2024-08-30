<?php

namespace Mrt\MrtCrud\Providers;

use Illuminate\Support\ServiceProvider;

class MrtCrudServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

        // Load stub files
        $this->publishes([
            __DIR__ . '/../stubs' => resource_path('stubs/vendor/mrt/mrt-crud'),
        ]);
    }

    public function register()
    {
        $this->commands([
            \Mrt\MrtCrud\Commands\MakeCrudCommand::class,
        ]);
    }

}
