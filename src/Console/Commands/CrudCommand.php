<?php

namespace HeyaTalent\LaraCRUD\Console\Commands;

use Illuminate\Console\Command;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controller, Model, Migration, Views and Route for resource.';

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
        $this->call('make:crud:controller', [
            'resource' => $this->argument('resource')
        ]);
        
        $migrationDateTime = now()->format('Y_m_d_his');

        $this->call('make:model', [
            'name' => ucfirst($this->argument('resource')),
            '--migration' => true,
        ]);

        $path = $this->buildMigrationPath($migrationDateTime);

        $this->call('migrate', [
            '--path' => $path
        ]);

        $this->call('make:crud:view', [
            'resource' => $this->argument('resource'),
        ]);

        $this->call('make:crud:route', [
            'resource' => $this->argument('resource'),
        ]);
    }

    public function buildMigrationPath($dateTime)
    {
        return 'database/migrations/' . 
            $dateTime . 
            '_create_' . 
            str_plural(strtolower($this->argument('resource'))) . 
            '_table.php';
    }
}