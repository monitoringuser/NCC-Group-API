<?php
namespace ApplicationTest\SelemiumTest\Application;

/**
 * @TODO remove! Fix library classmapping 'element-34/php-webdriver'
 */
require_once(dirname(__FILE__) . '/../../../../../vendor/element-34/php-webdriver/PHPWebDriver/WebDriver.php');

/**
 * Class Core
 *
 * @package Test\SelemiumTests\Application
 */
class Core extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPWebDriver_WebDriver
     */
    protected static $driver;

    /**
     * @var \PHPWebDriver_WebDriverSession
     */
    protected $session;

    /**
     * Setup
     */
    public function setUp() {
        self::$driver = new \PHPWebDriver_WebDriver();
        $this->session = self::$driver->session('firefox');
    }

    /**
     * Tear down
     */
    public function tearDown() {
        $this->session->close();
    }

}