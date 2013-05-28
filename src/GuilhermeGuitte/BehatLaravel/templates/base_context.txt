<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Zizaco\TestCases\ControllerTestCase,
    Zizaco\TestCases\IntegrationTestCase;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

class BaseContext extends BehatContext
{
    protected $testCase;
    protected $integrationCase;

    /**
     * Adding ability to run assertions at TestCase
     * @return  ControllerTestCase object
     */
    public function testCase()
    {
        if (! isset($this->testCase)) {
            $this->testCase = new ControllerTestCase;
            $this->testCase->setUp();
        }

        return $this->testCase;
    }

    /**
     * Adding ability to run assertions at fron_end test
     * @return  IntegrationTestCase object
     */
    public function integrationCase()
    {
        if (! isset($this->integrationCase)) {
            $this->integrationCase = new IntegrationTestCase;
            $this->integrationCase->setUp();
        }

        return $this->integrationCase;
    }

    /**
     * Dynamically retrieve attributes from the Main Context.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        if(isset($this->getMainContext()->$key))
        {
            return $this->getMainContext()->$key;
        }
        else
        {
            return null;
        }
    }

    /**
     * Dynamically set attributes om the Main Context.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function __set($key, $value)
    {
        // Set attribute
        $this->getMainContext()->$key = $value;
    }
}
