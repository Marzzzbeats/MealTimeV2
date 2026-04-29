<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include __DIR__ . "/../../db/db_connect.php"; 
    include __DIR__ . "/../../crud/notifs.crud.php"; 

    header('Content-Type: application/json');
    $type = $_GET["type"] ?? null;
    $data = json_decode(file_get_contents("php://input"), true);
    $from = $data["user_id"];
    $to = $data["owner"];

    $result = false;

    if($type == "followRequest"){
        $result = notifFollowRequest($conn, $from, $to);
    }

    if($type == "followAccepted"){
        $result = notifFollowAccepted($conn, $from, $to);
    }

    if($type == "newRecipe"){
        $result = notifNewRecipe($conn, $from, $to);
    }

    if($type == "deletedRecipe"){
        $result = notifDeletedRecipe($conn, $to);
    }

    echo json_encode([
        "success" => $result
    ]);

?>