<?php
/*
 * This file is part of php callable_equals()
 */

/**
 * @param callable $callable
 *
 * @return array|callable|string
 */
function callable_normalize(callable $callable)
{
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
