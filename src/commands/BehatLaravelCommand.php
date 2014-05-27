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
    protected $description = "Create Behat's folder structure";

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

        $this->question("Welcome to Laravel-Behat \n");

        $input = array();
        $input[] = '';
        
        $options = array('test_path');
        
        foreach ($options as $option) {
            if ( ($format = $this->input->getOption($option) ) ) {
                $input[$option] = $format;
            }
        }
        $this->comment("The following directories will be created: \n");

        if(!empty($input) && isset($input['test_path'])){
        $this->info($input['test_path']." /features \n");
        $this->info($input['test_path']." /contexts \n");
        }else{
            $this->info(" app/tests/acceptance/features \n");
            $this->info(" app/tests/acceptance/contexts \n");
        }
        $this->comment("See the documentation for more information.");

        $file_builder = new FileBuilder();

        $file_builder->makeStructure($input);

        $this->line('');
    }
    
    protected function getOptions()
    {
        return array(
            array('test_path', NULL, InputOption::VALUE_OPTIONAL, 'Specify a test path to install behat'),
        );
    }
}
