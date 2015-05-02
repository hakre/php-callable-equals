<?php
/*
 * This file is part of php callable_equals()
 */

/**
 * @param callable $callable
 *
 * @return callable if string (also in an array) in a normalized fashion. objects are already normalized.
 */
function callable_normalize(callable $callable)
{
    // closure and object calling magic ($callable->__invoke())
    if (is_object($callable)) {
        return $callable;
    }

    if (is_string($callable)) {
        $callable = strtolower($callable);
        $pieces   = explode("::", $callable);
        if (count($pieces) == 2) {
            return [$pieces[0], $pieces[1]];
        }

        return $callable;
    }

    if (is_string($callable[0])) {
        $callable[0] = strtolower($callable[0]);
    }

    $callable[1] = strtolower($callable[1]);

    return $callable;
}
