<?php
/*
 * just a little sandbox to try with callables
 */

require_once __DIR__ . '/../test/CallableStubs.php';

var_dump(call_user_func(new InvokableStub));
var_dump(StaticCallableStub::method());
