<?php namespace GuilhermeGuitte\BehatLaravel;

class Builder
{
    protected $testPath = 'app/tests';

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

    /**
     * Clean the folder structure
     *
     * @return null
     */
    protected function cleanFolders()
    {
        unlink($this->getAcceptancePath());
    }

    /**
     * Create the folder
     * @param  string $folderPath the folders path
     * @return null
     */
    protected function createFolder($folderPath)
    {
        if (! file_exists($folderPath)) {
            mkdir($folderPath);
        }
    }
}
