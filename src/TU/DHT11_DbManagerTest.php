<?php

/**
 * DHT11_DbManager test case.
 */
class DHT11_DbManagerTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var DHT11_DbManager
     */
    private $dHT11_DbManager;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated DHT11_DbManagerTest::setUp()

        $this->dHT11_DbManager = new DHT11_DbManager(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated DHT11_DbManagerTest::tearDown()
        $this->dHT11_DbManager = null;

        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }
}

