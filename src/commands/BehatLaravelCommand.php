<?php namespace GuilhermeGuitte\BehatLaravel;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BehatLaravelCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'behat:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Behat`s folder structure';

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
        $testPath = $this->option('test_path');

        if (isset($testPath)) {
            $testPath = 'app/tests';
        }

        $this->line('');

        $this->comment(
            "Will be create the following folders/files at $testPath: \n" .
            " $testPath/acceptance/features \n" .
            " $testPath/acceptance/contexts \n" .
            "See the the doc to more information"
        );

        $file_builder = new FileBuilder($testPath);

        $file_builder->makeStructure($this->option('force'));

        $this->line('');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        $app = app();

        return array(
            array('test_path', null, InputOption::VALUE_OPTIONAL, 'The test path.'),
            array('force', null, InputOption::VALUE_OPTIONAL, 'Force the creation of file/folders', false)
        );
    }
}
