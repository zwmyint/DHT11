<?php

/**
 * MeasureManager test case.
 */
class MeasureManagerTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var MeasureManager
     */
    private $measureManager;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated MeasureManagerTest::setUp()

        $this->measureManager = new MeasureManager(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated MeasureManagerTest::tearDown()
        $this->measureManager = null;

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

