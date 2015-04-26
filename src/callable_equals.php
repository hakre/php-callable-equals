<?php
/*
 * This file is part of php callable_equals()
 */

if(!function_exists('callable_equals')){
    require_once __DIR__ . '/callable_normalize.php';

    /**
     * Tests two or more callables for equality.
     *
     * @param callable ...$callables
     * @param bool $strict (optional, defaults to true)
     * @return bool|null
     */
    function callable_equals(){
        $strict = true;
        $callables = func_get_args();

        if (!$callables) {
            throw new InvalidArgumentException(
                "callable_equals() requires at least 2 callables for comparison");
        }

        if(is_bool(end($callables))) {
            $strict = array_pop($callables);
        }

        if(count($callables) < 2){
            throw new InvalidArgumentException(
                "callable_equals() requires at least 2 callables for comparison");
        }

        foreach($callables as $i => $callable){
            if(!is_callable($callable)){
                throw new InvalidArgumentException(
                    sprintf(
                        "Argument %d passed to callable_equals() must be callable, %s given"
                        , $i + 1, gettype($callable)));
            }else{
                $callables[$i] = callable_normalize($callable);
            }
        }

        $callable = array_shift($callables);
        while($callables){
            if($strict ? $callable !== $callables[0] : $callable != $callables[0])
                return false;
            $callable = array_shift($callables);
        }
        return true;
    }
}
