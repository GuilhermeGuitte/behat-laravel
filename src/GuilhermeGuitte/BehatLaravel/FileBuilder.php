<?php namespace GuilhermeGuitte\BehatLaravel;

class FileBuilder extends Builder
{
    /**
     * Create the folders and create the templates
     *
     * @param  boolean $force
     * @return null
     */
    public function makeStructure($options = null)
    {
        if (null!== $options && isset($options['test_path'])) {
            $this->testPath = $options['test_path'];
        }
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
     * @return null
     */
    protected function createFolders()
    {
        $paths = array(
            $this->testPath,
            $this->getAcceptancePath(),
            $this->getContextPath(),
            $this->getFeaturePath()
        );

        foreach ($paths as $path) {
            $this->createFolder($path);
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
        $paths = array(
            'base' => $this->getContextPath() . '/BaseContext.php',
            'feature' => $this->getContextPath() . '/FeatureContext.php'
        );

        foreach ($paths as $name => $path) {
            $this->createFile($path, $this->getTemplate($name));
        }
    }
}
