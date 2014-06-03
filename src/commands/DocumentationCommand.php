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

        $path = "report_test.html";

        if($this->input->getOption('out')) {
            $path = $this->input->getOption('out');
        }
        
        $profile = $this->option('profile');
        if(!empty($profile)){
            $profile_config = $this->loadConfig($profile);
        }else{
            $profile = 'default';
            $profile_config = $this->loadConfig($profile);
        }
        
        $input[] = realpath($profile_config['paths']['features'].'/../');
        $input[] = '--format=html';
        $input[] = '--out=' . $path;
        $input[] = '--profile=' . $profile;

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
            array('profile', 'p', InputOption::VALUE_REQUIRED, 'Specify a profile from behat.yml'),
        );
    }
    
    /**
     * Load the profile specific config
     *
     * @param string $profile
     * @return array|NULL
     */
    protected function loadConfig($profile){
    
        if(!empty($this->config)){
            return (isset($this->config[$profile]))? $this->config[$profile] : null;
        }
        return null;
    }
}
