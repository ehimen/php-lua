<?php

$lua1 = new Lua();
$lua2 = new Lua();

$lua1->registerCallback('foo', function () {
    echo "foo()\n";
});

$lua1->call('foo');

$lua2->registerCallback('bar', function () {
    echo "bar()\n";
});

$lua2->call('bar');

try {
    $lua1->call('bar');
} catch (LuaException $e) {
    echo "\$lua1 does not have bar()\n";
}

try {
    $lua2->call('foo');
} catch (LuaException $e) {
    echo "\$lua2 does not have foo()\n";
}

echo "Done\n";