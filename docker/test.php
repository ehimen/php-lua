<?php

ini_set('display_errors', 1);
ini_set('error_reporting', -1);

$lua = new Lua();


// Adapted from https://github.com/ComaVN/php-lua-memoryleak

$start = memory_get_usage();
printf("Mem at start of test (real): %d (%d)\n", memory_get_usage(), memory_get_usage(true));

for ($i = 0; $i < 100; ++$i) {
    //printf("Mem at start of loop (real): %d (%d)\n", memory_get_usage(), memory_get_usage(true));

    $lua = new Lua();

    $lua->registerCallback('foo', function () {
        echo "invoked foo()\n";
    });

    $lua->assign('bar', 13);

    $lua->call('foo');

    //printf("Mem at end of loop (real): %d (%d)\n", memory_get_usage(), memory_get_usage(true));
}

$lua = null;

printf("Mem at end of test (real):   %d (%d)\n", memory_get_usage(), memory_get_usage(true)); // foo
printf("Increase: %d\n", memory_get_usage() - $start);


