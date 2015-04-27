<?php
/*
 * This file is part of php callable_equals()
 */

if (!function_exists('function_stub')) {

/**
 * Class CallableStubs
 */
class CallableStubs
{
    private static $instance;

    /**
     * return CallableStubs
     */
    public static function create()
    {
        if (!self::$instance) {
            self::$instance = new CallableStubs();
        }

        return self::$instance;
    }

    public function getValidCallbacks() {
        return [
            'trim',
            [new Exception('hello'), 'getMessage'],
            'function_stub',
            function () {},
            [new CallableStub, 'dynamic'],
            ['StaticCallableStub', 'dynamic'],
            'StaticCallableStub::dynamic',
            new InvokableStub(),
            'ClassStub::method',
            ['ClassStub', 'method'],
            [new ClassStub, '__construct'],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidCallbacks() {
        return [
            null,
            0,
            42,
            new EmptyIterator(),
            'ClassStub::noMethod',
        ];
    }
}

/*
 * following are stub functions and classes to be used in testing
 */

function function_stub()
{
}

class ClassStub
{
    function __construct()
    {
    }

    static function method()
    {
    }
}

class CallableStub
{
    function __call($name, $arguments)
    {
    }
}

class StaticCallableStub
{
    public static function __callStatic($name, $arguments)
    {
    }
}


class InvokableStub
{
    function __invoke()
    {
    }
}

}
