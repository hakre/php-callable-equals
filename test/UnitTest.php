<?php
/*
 * This file is part of php callable_equals()
 */

/**
 * Class UnitTest
 */
class UnitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function callWithNoArguments()
    {
        callable_equals();
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function callWithOneArgument()
    {
        callable_equals('callable_equals');
    }

    /**
     * @test
     */
    public function callWithTwoArguments()
    {
        $this->assertTrue(callable_equals('callable_equals', 'callable_equals'));
        $this->assertFalse(callable_equals('callable_equals', 'trim'));
        try {
            callable_equals('callable_equals', false);
            $this->fail('an expected exception was not thrown');
        } catch (InvalidArgumentException $e){
            $this->addToAssertionCount(1);
        }

        // okay also with three
        $this->assertFalse(callable_equals('callable_equals', 'trim', true));
    }

    /**
     * @test
     */
    public function requireExisting()
    {
        $this->assertTrue(function_exists('callable_equals'));
        $this->assertEmpty(error_get_last());
        require __DIR__ . '/../src/callable_equals.php';
        $this->assertEmpty(error_get_last());
    }

    /**
     * @test
     */
    public function invalidCallables()
    {
        $object = new EmptyIterator();
        $valid = [$object, 'valid'];
        $this->assertTrue(callable_equals($valid, $valid));

        /** @link file:///data/callable-error-message.php */
        $expected = 'Argument 1 passed to callable_equals() must be callable, string given';

        try {
            callable_equals('isset', $valid);
            $this->fail('an expected exception has not been thrown');
        } catch (InvalidArgumentException $e) {
            $this->addToAssertionCount(1);
            $this->assertEquals($expected, $e->getMessage());
        }
    }
}
