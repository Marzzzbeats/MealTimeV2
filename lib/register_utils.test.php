<?php
    include './register_utils.php';

    //test ok
    $p1 = "bonjour123";
    $p2 = "bonjour123";
    $res = pwordOk($p1, $p2);
    echo('<p>Test 1 (ok) </p>');
    echo($res);

    //test Nok
    $p12 = "bonjour123";
    $p22 = "bonjour12345";
    $res2 = pwordOk($p12, $p22);
    echo('<p>Test 2 (Nok) </p>');
    echo($res2);



?>