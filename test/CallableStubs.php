<?php
/*
 * This file is part of php callable_equals()
 */

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
            'StaticCallableStub::dynamic',
            new InvokableStub(),
            'ClassStub::method',
            ['ClassStub', 'method'],
            [new ClassStub, '__construct'],
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
