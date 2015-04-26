<?php
/*
 * This file is part of php callable_equals()
 */

/**
 * Class CallableTestCase
 */
abstract class CallableTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @see IntegrationTest::normalization
     * @see IntegrationTest::equality
     */
    public function provideCallables()
    {
        return $this->provideParameterFromArray(CallableStubs::create()->getValidCallbacks());
    }

    /**
     * @param array $array
     *
     * @return array
     */
    protected function provideParameterFromArray(array $array) {
        $sets = [];
        foreach ($array as $entry) {
            $sets[] = [$entry];
        }
        return $sets;
    }
}
