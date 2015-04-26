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
}
