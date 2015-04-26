<?php
/*
 * This file is part of php callable_equals()
 */

require_once __DIR__ . '/CallableStubs.php';

/**
 * Class UnitTest
 */
class NormalizeUnitTest extends CallableTestCase
{
    /**
     * @test function names are not case sensitive in PHP
     */
    public function functionCaseSensitivity()
    {
        // class names are not case sensitive in PHP
        $this->assertEquals(
            callable_normalize('tRiM'),
            callable_normalize('TrIm')
        );
    }

    /**
     * @test class names are not case sensitive in PHP
     */
    public function classCaseSensitivity()
    {
        $this->assertEquals(
            callable_normalize('ClassStub::method'),
            callable_normalize('CLASSSTUB::method')
        );

        $this->assertEquals(
            callable_normalize(['ClassStub', 'method']),
            callable_normalize(['CLASSSTUB', 'method'])
        );

        $this->assertEquals(
            callable_normalize('ClassStub::method'),
            callable_normalize(['CLASSSTUB', 'method'])
        );
    }

    /**
     * @test method names are not case sensitive in PHP
     */
    public function methodCaseSensitity() {
        $this->assertEquals(
            callable_normalize('ClassStub::method'),
            callable_normalize('CLASSSTUB::METHOD')
        );

        $this->assertEquals(
            callable_normalize(['ClassStub', 'method']),
            callable_normalize(['CLASSSTUB', 'METHOD'])
        );

        $this->assertEquals(
            callable_normalize('ClassStub::method'),
            callable_normalize(['CLASSSTUB', 'METHOD'])
        );
    }
}
