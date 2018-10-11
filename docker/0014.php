<?php
$l = new lua();
$l->eval(<<<CODE
function test(a)
    print("test() called")
    lua_fcn(a)
end
CODE
);

$l->registerCallback("lua_fcn", function($a) {
    ksort($a);
    var_dump($a);
});
$l->test(array("key1"=>"v1",
                "key2"=>"v2"));

echo "\ndone\n";