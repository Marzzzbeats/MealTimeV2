<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include "/home/perivolas/public_html/mealtime/db/db_connect.php"; 
    include "/home/perivolas/public_html/mealtime/crud/notifs.crud.php"; 

    $conn = connection();

    header('Content-Type: application/json');

?>

<?php

$data = getNotifs($conn);
echo(json_encode($data));

?>