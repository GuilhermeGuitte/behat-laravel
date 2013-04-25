<?php namespace GuilhermeGuitte\BehatLaravel;

class FileBuilder
{

    protected $testPath = 'app/tests';
    protected $errors = array();

    function __construct($testPath)
    {
        if ($testPath)
            $this->testPath = $testPath;
    }

    /**
     * Create the folders and create the templates
     *
     * @param  boolean $force
     * @return null
     */
    public function makeStructure($force)
    {
        $this->createFolders();
        $this->createBehatConfig();
        $this->createTemplatesFiles();
    }

    /**
     * Create the folder structure to:
     * testPath
     * acceptancePath
     * contextPath
     * featurePath
     * @return [type] [description]
     */
    protected function createFolders()
    {
        $paths = [
            $this->testPath,
            $this->getAcceptancePath(),
            $this->getContextPath(),
            $this->getFeaturePath()
        ];

        foreach ($paths as $path) {
            if (! file_exists($path)) {
                mkdir($path);
            }
        }
    }

    /**
     * Create the behat config
     *
     * @return null
     */
    protected function createBehatConfig()
    {
        $behatConfig = file_get_contents(dirname(__FILE__) . "/templates/behat_config.txt");
        $behatConfig = str_replace("{testPath}", $this->testPath, $behatConfig);

        $this->createFile('app/../behat.yml', $behatConfig);
    }

    /**
     * Create the BaseContext.php and FeatureContext.php at:
     *  $testPath/acceptance/contexts/
     *
     * @return null
     */
    protected function createTemplatesFiles()
    {
        $paths = [
            'base' => $this->getContextPath() . '/BaseContext.php',
            'feature' => $this->getContextPath() . '/FeatureContext.php'
        ];

        foreach ($paths as $name => $path) {
            $this->createFile($path, $this->getTemplate($name));
        }
    }

    /**
     * Return the template
     * @param  string $name name of template
     *
     * @return return the content of template
     */
    protected function getTemplate($name)
    {
        return file_get_contents(dirname(__FILE__) . "/templates/". $name . "_context.txt");
    }

    /**
     * Return the path of context that should be create
     *
     * @return string
     */
    protected function getContextPath()
    {
        return $this->testPath . "/acceptance/contexts";
    }


    /**
     * Return the path of features that should be create
     *
     * @return string
     */
    protected function getFeaturePath()
    {
        return $this->testPath . "/acceptance/features";
    }

    /**
     * Return the acceptance path that should be create
     *
     * @return [type] [description]
     */
    protected function getAcceptancePath()
    {
        return $this->testPath . "/acceptance";
    }

    /**
     * Create the files passed
     * @param  string $path        file should be created
     * @param  string $inputToFile content to insert at file
     *
     * @return null
     */
    protected function createFile($path, $inputToFile)
    {
        if (! file_exists($path)) {
            $fs = fopen($path, 'x');

            if ( $fs )
            {
                fwrite($fs, $inputToFile);
                fclose($fs);
            }
        }
    }
}
