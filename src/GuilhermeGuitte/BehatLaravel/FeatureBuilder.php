<?php namespace GuilhermeGuitte\BehatLaravel;

class FeatureBuilder extends Builder
{

    protected $feature = '';

    function __construct($feature)
    {
        $this->feature = $feature;
    }

    /**
     * @param array $paths
     *
     * @return void
     */
    public function makeFeature(array $paths)
    {
        $this->createFeatureFile($this->createFeatureFolder($paths['features']));
        $this->createContextFile($paths['bootstrap']);
    }

    /**
     * @param $featurePath path to the features folder to create a new feature folder
     *
     * @return $path
     */
    protected function createFeatureFolder($featurePath)
    {
        $path = $featurePath . "/" . $this->ruby_case($this->feature);
        $this->createFolder($path);
        return $path;
    }

    /**
     * @param $featurePath path to the features folder to create a new feature file
     *
     * @return void
     */
    protected function createFeatureFile($featurePath)
    {
        $path = $featurePath .
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
    protected function createContextFile($bootPath)
    {
        $path = $bootPath . '/' . $this->feature . "Context.php";

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
