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
        $feature = $this->option('name');

        $message = "The feature $feature will be created".
        " in app/tests/acceptance/features/$feature directory";

        $this->comment( $message );
        $this->line('');

        if ( $this->confirm("Proceed with the feature creation? [Yes|no]") )
        {

            $this->line('');
            $this->info( "Creating feature..." );

            $file_builder = new FeatureBuilder($feature);
            $file_builder->makeFeature();

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
            array('name', null, InputOption::VALUE_REQUIRED, "Feature's name")
        );
    }
}
