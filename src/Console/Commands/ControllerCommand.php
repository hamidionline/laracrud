<?php

namespace HeyaTalent\LaraCRUD\Console\Commands;

use Illuminate\Console\Command;

class ControllerCommand extends Command
{
    use \Illuminate\Console\DetectsApplicationNamespace;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud:controller {resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controller for resource.';

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

        file_put_contents(
            base_path('app/Http/Controllers/' . ucfirst(str_plural($this->resource_name)) . 'Controller.php'),
            $this->compileStub('controller.stub'),
            FILE_APPEND
        );

        $this->info('Resourceful ' . ucfirst(str_plural($this->resource_name)) . 'Controller created.');
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
                '{{namespace}}'
            ],
            [ 
                $this->resource_name, 
                ucfirst($this->resource_name), 
                str_plural(ucfirst($this->resource_name)),
                str_plural($this->resource_name), 
                $this->getAppNamespace(),
            ],
            file_get_contents(__DIR__ . '/../../Stubs/Controller/' . $stub)
        );
    }
}