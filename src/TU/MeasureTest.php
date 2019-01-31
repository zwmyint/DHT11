<?php

/**
 * Measure test case.
 */
class MeasureTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Measure
     */
    private $measure;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated MeasureTest::setUp()

        $this->measure = new Measure(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated MeasureTest::tearDown()
        $this->measure = null;

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

