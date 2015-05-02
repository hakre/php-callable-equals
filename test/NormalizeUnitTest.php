<?php
/*
 * This file is part of php callable_equals()
 */

/**
 * Class UnitTest
 */
class NormalizeUnitTest extends CallableTestCase
{
    /**
     * @test
     * @dataProvider provideInvalidCallables
     *
     * @param mixed $invalid callback
     */
    public function invalidArgumentExceptionOnCatchableFatalError($invalid)
    {
        // pre-condition
        $this->assertFalse(is_callable($invalid));

        $exception = null;

        try {
            $this->addToAssertionCount(1);
            callable_normalize($invalid);
            $this->fail('');
        } catch (PHPUnit_Framework_Error $exception) {
        } /** @noinspection PhpUndefinedClassInspection PHP 7 */
          catch (TypeException $exception) {
        } catch (Exception $exception) {
            $this->fail(sprintf('Unexpected exception %s', get_class($exception)));
        } /** @noinspection PhpUndefinedClassInspection PHP 7 */
          catch (BaseException $exception) {
            $this->fail(sprintf('Unexpected exception %s', get_class($exception)));
        }

        $this->assertNotNull($exception, 'An expected exception was not thrown');

        $message = $exception->getMessage();
        $pattern = '~^Argument 1 passed to callable_normalize\\(\\) must be (?:an instance of )?callable, (?:\w+) given~';
        $this->assertRegExp($pattern, $message);
    }

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
