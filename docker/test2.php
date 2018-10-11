<?php

$foo = function () {
    echo "foo()\n";
};

$lua = new \Lua();

$lua->registerCallback('foo', $foo);

$lua->call('foo');

\Lua::reset();

$lua->call('foo');

//$lua->registerCallback('foo', function() {
//    echo "foo()\n";
//});