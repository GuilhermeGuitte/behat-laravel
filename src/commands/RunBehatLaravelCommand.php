<?php namespace GuilhermeGuitte\BehatLaravel;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RunBehatLaravelCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'behat:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the all acceptance tests';

    /**
     * Illuminate application instance.
     *
     * @var Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create a new BehatLaravel command instance.
     *
     * @param  GuilhermeGuitte\BehatLaravel  $behat
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        passthru('clear');

        $this->line('');

        $this->comment("Running acceptance tests... \n\n");

        // Running with output color
        $app = new \Behat\Behat\Console\BehatApplication('DEV');
        $app->run(new \Symfony\Component\Console\Input\ArgvInput(['app/tests/acceptance']));
    }
}
