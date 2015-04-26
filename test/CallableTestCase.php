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
