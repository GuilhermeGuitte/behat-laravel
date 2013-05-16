<?php namespace GuilhermeGuitte\BehatLaravel;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DocumentationCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'behat:html';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate HTML file with test's results";

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

        $path = "report_test.html";

        if($this->input->getOption('out')) {
            $path = $this->input->getOption('out');
        }

        $input[] = 'app/tests/acceptance';
        $input[] = '--format=html';
        $input[] = '--out=' . $path;

        $this->comment("Creating doc...");

        $app = new \Behat\Behat\Console\BehatApplication('DEV');
        $app->run(new \Symfony\Component\Console\Input\ArgvInput(
            $input
        ));
    }

    protected function getOptions()
    {
        return array(
            array('out', 'o', InputOption::VALUE_OPTIONAL, 'Choose where file path should be created.'),
        );
    }
}
