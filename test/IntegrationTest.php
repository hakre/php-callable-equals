<?php
/*
 * This file is part of php callable_equals()
 */

/**
 * Class IntegrationTest
 */
class IntegrationTest extends CallableTestCase
{
    /**
     * @test
     * @dataProvider provideCallables
     */
    public function normalization($callable)
    {
        callable_normalize($callable);
        $this->addToAssertionCount(1);
    }

    /**
     * @test
     * @dataProvider provideCallables
     */
    public function equality($callable)
    {
        $result = callable_equals($callable, $callable, false);
        $this->assertTrue($result);

        $result = callable_equals($callable, $callable, true);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @dataProvider provideInvalidCallables
     */
    public function invalidityEquality($callable)
    {
        $exception = null;

        try {
            callable_equals($callable, $callable, false);
        } catch (InvalidArgumentException $exception) {
            $message = $exception->getMessage();
            $this->assertStringStartsWith('Argument 1 passed to callable_equals() must be callable, ', $message);
        } catch (Exception $exception) {
            // PHP < 7 branch
        } catch (BaseException $exception) {
            // PHP 7 branch
        }

        $this->assertInstanceOf('InvalidArgumentException', $exception);
    }
}
