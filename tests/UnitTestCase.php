<?php

class UnitTestCase extends PHPUnit_Framework_TestCase
{
    use EloquentRelationsTrait;

    /**
     * Terminate the mockery.
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
