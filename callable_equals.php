<?php

if(!function_exists('callable_equals')){
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

        if(is_bool($callables[count($callables) - 1])){
            $strict = $callables[count($callables) - 1];
            $callables = array_splice($callables, 0, -1);
        }

        $normalizeCallable = function(callable $callable){
            if(is_string($callable)){
                $callable = strtolower($callable);
                $pieces = explode("::", $callable);
                if(count($pieces) == 2){
                    return [$pieces[0], $pieces[1]];
                }
                return $callable;
            }
            if(is_string($callable[0])){
                $callable[0] = strtolower($callable[0]);
            }
            $callable[1] = strtolower($callable[1]);
            return $callable;
        };

        if(count($callables) < 2){
            trigger_error("callable_equals() requires at least 2 callables for comparison.", E_USER_WARNING);
            return null;
        }
        
        foreach($callables as $i => $callable){
            if(!is_callable($callable)){
                trigger_error("Argument " . ($i + 1) . " is not a callable.", E_USER_WARNING);
                return null;
            }else{
                $callables[$i] = $normalizeCallable($callable);
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