<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

class BaseContext extends BehatContext
{
    protected $testCase;
    protected $acceptanceCase;

    // Adding ability to run assertions at TestCase
    public function testCase()
    {
        if (! isset($this->testCase)) {
            $this->testCase = new ControllerTestCase;
            $this->testCase->setUp();
        }

        return $this->testCase;
    }

    // Adding ability to run assertions at fron_end test
    public function acceptanceCase()
    {
        if (! isset($this->acceptanceCase)) {
            $this->acceptanceCase = new AcceptanceTestCase;
            $this->acceptanceCase->setUp();
        }

        return $this->acceptanceCase;
    }
}
