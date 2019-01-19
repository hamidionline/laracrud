<?php

namespace HeyaTalent\LaraCRUD\Console\Commands;

use Illuminate\Console\Command;

class RouteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud:route {resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Route for resource.';

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
            base_path('routes/web.php'),
            $this->compileStub('routes.stub'),
            FILE_APPEND
        );

        $this->info('Route added to routes/web.php file');
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
            file_get_contents(__DIR__ . '/../../Stubs/Route/' . $stub)
        );
    }
}