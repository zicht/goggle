<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Hook\Call\AfterScenario;
use Webmozart\Assert\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $createdFiles = [];
    private $response = '';
    private $exitCode = 0;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^there is a file named "([^"]*)" with contents$/
     */
    public function thereIsAFileNamedWithContents($arg1, PyStringNode $string)
    {
        file_put_contents($arg1, $string->getRaw());
        $this->createdFiles[] = $arg1;
    }

    /**
     * @Given /^there is a file named "([^"]*)" with contents from "([^"]*)"$/
     */
    public function thereIsAFileNamedWithContentsFrom($arg1, $arg2)
    {
        if (is_file($arg1)) {
            unlink($arg1);
        }
        copy(__DIR__ . '/../assets/' . $arg2, $arg1);
        $this->createdFiles[] = $arg1;
    }

    /**
     * @Given I am in a test dir
     */
    public function iAmInATestDir()
    {
        $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "behat-test";
        mkdir($dir, 0777, true);
        $this->createdFiles[]= $dir;
        chdir($dir);
    }

    /**
     * @When I execute goggle with arguments :arg1
     */
    public function iExecuteGoggleWithArguments($arg1)
    {
        $binary = __DIR__ . '/../../bin/goggle';
        $this->response = shell_exec($binary . ' ' . $arg1 . ' 2>&1');
    }

    /**
     * @When I execute piped goggle with arguments :arg1
     */
    public function iExecutePipedGoggleWithArguments($arg1)
    {
        $binary = __DIR__ . '/../../bin/goggle ' . $arg1;
        $desc = [];
        $pp = proc_open($binary, [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']], $desc);
        fwrite($desc[0], $this->response);
        fclose($desc[0]);
        $this->response = stream_get_contents($desc[1]);
        $this->response .= stream_get_contents($desc[2]);
        fclose($desc[1]);
        fclose($desc[2]);
        $this->exitCode = proc_get_status($pp);
    }


    /**
     * @AfterScenario
     */
    public function cleanup()
    {
        while ($file = array_pop($this->createdFiles)) {
            if (is_file($file)) {
                @unlink($file);
            }
            if (is_dir($file)) {
                rmdir($file);
            }
        }
    }

    /**
     * @Then /^I should see formatted json$/
     */
    public function iShouldSeeFormattedJson(PyStringNode $string)
    {
        Assert::eq(trim($this->response), trim(json_encode(json_decode($string->getRaw()), JSON_PRETTY_PRINT)));
    }

    /**
     * @Then /^I should see$/
     */
    public function iShouldSee(PyStringNode $string)
    {
        Assert::eq(trim($this->response), trim($string->getRaw()));
    }

    /**
     * @Then /^print last output$/
     */
    public function printLastOutput()
    {
        echo $this->response;
    }

    /**
     * @When /^I execute goggle with arguments$/
     */
    public function iExecuteGoggleWithArguments1(PyStringNode $string)
    {
        return $this->iExecuteGoggleWithArguments(trim($string->getRaw()));
    }


    protected function filepath($file)
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . $file;
    }
}
