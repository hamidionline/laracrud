<?php

namespace HeyaTalent\LaraCRUD;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \HeyaTalent\LaraCRUD\Console\Commands\ControllerCommand::class,
                \HeyaTalent\LaraCRUD\Console\Commands\CrudCommand::class,
                \HeyaTalent\LaraCRUD\Console\Commands\RouteCommand::class,
                \HeyaTalent\LaraCRUD\Console\Commands\ViewCommand::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
