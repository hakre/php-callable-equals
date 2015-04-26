<?php
/*
 * This file is part of php callable_equals()
 */

/**
 * Class CallableStubsTests
 */
class CallableStubsTests extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function creation()
    {
        $this->assertInstanceOf('CallableStubs', CallableStubs::create());
    }

    /**
     * @test
     */
    public function sandbox()
    {
        include __DIR__ . '/../data/callables-sandbox.php';
        $this->addToAssertionCount(1);
    }
}
