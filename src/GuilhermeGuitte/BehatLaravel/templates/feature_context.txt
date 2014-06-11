<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'vendor/autoload.php';
require_once 'vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

class FeatureContext extends BaseContext
{
    /**
     * Initializes context.
     * Load other context files
     *
     * @param array $parameters context parameters (set up via behat.yml)
     */
    public function __construct(array $parameters) {

        // import all context classes from context directory, except the abstract one
        $filesToSkip = ['FeatureContext.php', 'BaseContext.php'];

        $path = dirname(__FILE__);
        $it = new RecursiveDirectoryIterator($path);

        foreach ($it as $file)
        {
            if (! $file->isDir()) {
               $name = $file->getFilename();

                if (in_array($name, $filesToSkip))
                    continue;

                $class = pathinfo($name, PATHINFO_FILENAME);
                require_once $path.'/'.$name;
                $this->useContext($class, new $class($parameters));
            }
        }
    }
}
