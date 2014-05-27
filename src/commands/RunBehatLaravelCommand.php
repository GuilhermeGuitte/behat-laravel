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
     * Config from behat.yml
     * @var array
     */
    protected $config;
    
    /**
     * Create a new BehatLaravel command instance.
     *
     * @param  GuilhermeGuitte\BehatLaravel  $behat
     * @return void
     */
    public function __construct($config)
    {
        $this->config = $config;
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

        $input = array();
        $input[] = '';

        $options = array('format', 'no-snippets','tags', 'out');

        foreach ($options as $option) {
            if ( ($format = $this->input->getOption($option) ) ) {
                $input[] = "--$option=".$format;
            }
        }

        $input[] = 'app/tests/acceptance/features/'.$this->input->getArgument('feature');

        // Running with output color
        $app = new \Behat\Behat\Console\BehatApplication('DEV');
        $app->run(new \Symfony\Component\Console\Input\ArgvInput(
            $input
        ));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('feature', InputArgument::OPTIONAL, 'Runs tests in the specified folder or file only.'),
        );
    }

    protected function getOptions()
    {
        return array(
            array('format', 'f', InputOption::VALUE_REQUIRED, 'Choose a formatter from <caption>pretty</caption> (default), progress, html, junit, failed, snippets.'),
            array('tags', NULL, InputOption::VALUE_REQUIRED, 'Only execute the features or scenarios with tags matching the tag filter expression.'),
            array('no-snippets', NULL, InputOption::VALUE_NONE, 'Don\'t print snippets for unmatched steps'),
            array('profile', 'p', InputOption::VALUE_REQUIRED, 'Specify a profile from behat.yml'),
            array('out', 'o', InputOption::VALUE_REQUIRED, 'Choose a formatter from <caption>pretty</caption> (default), progress, html, junit, failed, snippets.'),
        );
    }
}
