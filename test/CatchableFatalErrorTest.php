<?php
/*
 * This file is part of php callable_equals()
 */

/**
 * Class CatchableFatalErrorTest
 *
 * Test standard PHP behaviour with catchable fatal errors and the callable type-hint.
 */
class CatchableFatalErrorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function exception()
    {
        $test = function(callable $parameter) {
            $this->addToAssertionCount(1);
        };

        $exception = null;
        $pattern = '~^Argument 1 passed to CatchableFatalErrorTest::(?:{closure}|__invoke)\\(\\) must be (?:an instance of )?callable, (?:object|stdClass) given~';

        try {
            // just an invalid call
            $test(new stdClass());
            echo "No exception caught\n";
            $this->fail('An expected exception has not been thrown');
        } catch (PHPUnit_Framework_Error $exception) {
            $this->assertRegExp($pattern, $exception->getMessage());
            $this->assertEquals(E_RECOVERABLE_ERROR, $exception->getCode());
        } catch (TypeException $exception) {
            $this->assertRegExp($pattern, $exception->getMessage());
            $this->assertEquals(1, $exception->getCode());
        }
    }
}
