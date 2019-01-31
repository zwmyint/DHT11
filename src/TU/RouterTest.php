<?php

/**
 * Router test case.
 */
class RouterTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Router
     */
    private $router;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated RouterTest::setUp()

        $this->router = new Router(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated RouterTest::tearDown()
        $this->router = null;

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

