<?php namespace GuilhermeGuitte\BehatLaravel;

class FeatureBuilder extends Builder
{

    protected $feature = '';

    function __construct($feature)
    {
        $this->feature = $feature;
    }

    /**
     * Create the folders and create the templates
     *
     * @return null
     */
    public function makeFeature()
    {
        $this->createFeatureFolder();
        $this->createFeatureFile();
        $this->createContextFile();
    }

    /**
     * Create the Features folder at app/tests
     *
     * @return null
     */
    protected function createFeatureFolder()
    {
        $path = $this->getFeaturePath() . "/" . $this->ruby_case($this->feature);
        $this->createFolder($path);
    }

    /**
     * Create the features files
     *
     * @return null
     */
    protected function createFeatureFile()
    {
        $path = $this->getFeaturePath() .
                "/" . $this->ruby_case($this->feature) .
                "/" . $this->ruby_case($this->feature) . '.feature';

        $template = $this->getTemplate('feature_structure');

        $template = str_replace("{feature_name}", $this->feature, $template);

        $this->createFile($path, $template);
    }

    /**
     * Create the Context File
     *
     * @return null
     */
    protected function createContextFile()
    {
        $path = $this->getContextPath() . '/' . $this->feature . "Context.php";

        $template = $this->getTemplate('structure');

        $template = str_replace("{feature_name}", $this->feature, $template);

        $this->createFile($path, $template);
    }

    /**
     * Change the CamelCase string passed to underscore_string
     * @param  string $str
     *
     * @return string
     */
    protected function ruby_case($str) {
        $str[0] = strtolower($str[0]);
        $func = create_function('$c', 'return "_" . strtolower($c[1]);');
        return preg_replace_callback('/([A-Z])/', $func, $str);
    }
}
