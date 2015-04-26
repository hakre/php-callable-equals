<?php
/*
 * This file is part of php callable_equals()
 *
 * get error message on callable type-hint
 */

$test = function(callable $parameter) {};

// catchable fatal error
$old = set_error_handler(function($code, $message) use (&$error_message) {
    $error_message = substr($message, 0, strpos($message, ', called in '));
    return true;
});
$test('isset');
restore_error_handler();

var_dump($error_message);
