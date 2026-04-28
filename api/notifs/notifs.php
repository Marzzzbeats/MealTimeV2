<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include __DIR__ . "/../../db/db_connect.php"; 
    include __DIR__ . "/../../crud/notifs.crud.php"; 


    header('Content-Type: application/json');

?>

<?php
if(isset($_GET["user_id"])){
    $id = $_GET["user_id"];
    $data = getUnreadNotifs($conn, $id);
    if($data){
        echo(json_encode($data));
    }
}

?>