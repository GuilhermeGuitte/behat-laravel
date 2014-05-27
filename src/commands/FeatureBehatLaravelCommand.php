<?php namespace GuilhermeGuitte\BehatLaravel;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FeatureBehatLaravelCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'behat:feature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an feature and contexts';

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
        
        $feature = $this->option('name');
        
        $profile = $this->option('profile');
        
        if(!empty($profile)){
            $profile_config = $this->loadConfig($profile);
        }else{
            $profile_config = $this->loadConfig('default');
        }
        
        $message = "The feature $feature will be created".
        " in ".$profile_config['paths']['features']."/features/".$feature. "directory";
        
        $this->comment( $message );
        $this->line('');

        if ( $this->confirm("Proceed with the feature creation? [Yes|no]") )
        {

            $this->line('');
            $this->info( "Creating feature..." );

            $file_builder = new FeatureBuilder($feature);
            $file_builder->makeFeature($profile_config['paths']['features']);

            $this->info( "Feature successfully created!" );
            $this->line('');
        }
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
            array('name', null, InputOption::VALUE_REQUIRED, "Feature's name"),
            array('profile', 'p', InputOption::VALUE_OPTIONAL, 'Specify a profile from behat.yml'),
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
