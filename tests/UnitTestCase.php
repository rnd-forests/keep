<?php

class UnitTestCase extends PHPUnit_Framework_TestCase
{
    use EloquentRelationsTrait;

    public function tearDown()
    {
        Mockery::close();
    }
}