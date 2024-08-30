<?php

namespace Mrt\MrtCrud\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeCrudCommand extends Command
{
    protected $signature = 'make:mrtCrud {name}';
    protected $description = 'Generate a CRUD for a given model name';
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $this->info("Creating CRUD for {$name}");

        $this->createModel($name);
        $this->createController($name);
        $this->createRequest($name);
        $this->createMigration($name);
        $this->addRoutes($name);

        $this->info("{$name} Model Generation Complete!");
        $this->info("{$name} Controller Generation Complete!");
        $this->info("{$name} Request Generation Complete!");
        $this->info("{$name} Database Generation Complete!");
        $this->info("{$name} Routes Generation Complete!");
    }

    // model create
    protected function createModel($name)
    {
        $path = app_path("Models/{$name}.php");
        $this->isDirExists(dirname($path));
        $stub = $this->files->get(__DIR__ . '/../stubs/Model.stub');
        $stub = str_replace('{{modelName}}', $name, $stub);
        $this->files->put($path, $stub);
    }

    // create controller
    protected function createController($name)
    {
        $path = app_path("Http/Controllers/{$name}Controller.php");
        $this->isDirExists(dirname($path));
        $stub = $this->files->get(__DIR__ . '/../stubs/Controller.stub');
        $stub = str_replace(['{{modelName}}', '{{modelNameLower}}'], [$name, Str::camel($name)], $stub);
        $this->files->put($path, $stub);
    }

    // create requests
    protected function createRequest($name)
    {
        $path = app_path("Http/Requests/{$name}Request.php");
        $this->isDirExists(dirname($path));
        $stub = $this->files->get(__DIR__ . '/../stubs/Request.stub');
        $stub = str_replace('{{modelName}}', $name, $stub);
        $this->files->put($path, $stub);
    }

    // create migrations
    protected function createMigration($name)
    {
        $tableName = Str::snake(Str::plural($name));
        $path = database_path("migrations/" . date('Y_m_d_His') . "_create_{$tableName}_table.php");
        $this->isDirExists(dirname($path));
        $stub = $this->files->get(__DIR__ . '/../stubs/Migration.stub');
        $stub = str_replace('{{tableName}}', $tableName, $stub);
        $this->files->put($path, $stub);
    }

    // create api routes
    protected function addRoutes($name)
    {
        $stub = $this->files->get(__DIR__ . '/../stubs/Route.stub');
        $stub = str_replace('{{modelName}}', $name, $stub);
        $stub = str_replace('{{modelNamePluralLowerCase}}', Str::plural(Str::camel($name)), $stub);
        $path = base_path('routes/api.php');
        $this->files->append($path, $stub);
    }
    // check directory
    protected function isDirExists($directory)
    {
        // is directory exists
        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }
}
