<?php

$lua = new Lua();


// Adapted from https://github.com/ComaVN/php-lua-memoryleak

printf("Mem at start of test (real): %d (%d)\n", memory_get_usage(), memory_get_usage(true));

for ($i = 0; $i < 100; ++$i) {
    printf("Mem at start of loop (real): %d (%d)\n", memory_get_usage(), memory_get_usage(true));

    \Lua::clearRegisteredCallbacks();

    $lua = new Lua();

    $lua->registerCallback('foo', function () {

    });

    printf("Mem at end of loop (real): %d (%d)\n", memory_get_usage(), memory_get_usage(true));
}
$lua = null;
printf("Mem at end of test (real):   %d (%d)\n", memory_get_usage(), memory_get_usage(true)); // foo


