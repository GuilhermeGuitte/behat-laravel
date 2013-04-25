<?php namespace GuilhermeGuitte\BehatLaravel;

use Illuminate\Support\ServiceProvider;

class BehatLaravelServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the commands.
     *
     * @return void
     */
    public function register()
    {
        $this->app['command.behat.install'] = $this->app->share(function($app)
        {
            return new BehatLaravelCommand();
        });

        $this->commands('command.behat.install');

        $this->app['command.behat.run'] = $this->app->share(function($app)
        {
            return new RunBehatLaravelCommand();
        });

        $this->commands('command.behat.run');
    }

}
