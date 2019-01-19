<?php

namespace HeyaTalent\LaraCRUD\Console\Commands;

use Illuminate\Console\Command;

class ViewCommand extends Command
{
    use \Illuminate\Console\DetectsApplicationNamespace;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud:view {resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Views for resource.';

    /**
     * The view stubs
     * @var array
     */
    protected $viewStubs = [
        'create.blade.stub' => 'create.blade.php',
        'edit.blade.stub'   => 'edit.blade.php',
        'index.blade.stub'  => 'index.blade.php',
        'show.blade.stub'   => 'show.blade.php',
    ];

    /**
     * The resource name
     * @var string
     */
    protected $resource_name;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->resource_name = strtolower($this->argument('resource'));

        $this->createDirectory(str_plural($this->resource_name));

        foreach ($this->viewStubs as $key => $value) {

            file_put_contents(
                resource_path('views/' . str_plural($this->resource_name) . '/' . $value),
                $this->compileStub($key)
            );
        }

        $this->info('View scaffolding generated successfully.');
    }

    /**
     * Create directory for the files
     * @param  string $resource_name Resource name
     * @return void           
     */
    public function createDirectory($resource_name)
    {
        if (!is_dir($directory = resource_path('views/' . $resource_name))) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Compiles the stub
     * @param  string $stub
     * @return string
     */
    public function compileStub($stub)
    {
        return str_replace(
            [ 
                '{{resource}}', 
                '{{uc_resource}}', 
                '{{uc_resource_plural}}',
                '{{resource_plural}}',
            ],
            [ 
                $this->resource_name, 
                ucfirst($this->resource_name), 
                str_plural(ucfirst($this->resource_name)),
                str_plural($this->resource_name), 
            ],
            file_get_contents(__DIR__ . '/../../Stubs/View/' . $stub)
        );
    }
}