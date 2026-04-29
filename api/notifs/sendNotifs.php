<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include __DIR__ . "/../../db/db_connect.php"; 
include __DIR__ . "/../../crud/notifs.crud.php"; 

header('Content-Type: application/json');

$type = $_GET["type"] ?? null;
$data = json_decode(file_get_contents("php://input"), true);

$result = false;

if($type == "followRequest"){
    $result = notifFollowRequest($conn, $data["from"], $data["to"]);
}

if($type == "followAccepted"){
    $result = notifFollowAccepted($conn, $data["from"], $data["to"]);
}

if($type == "newRecipe"){
    $result = notifNewRecipe($conn, $data["from"], $data["to"]);
}

if($type == "deletedRecipe"){
    $result = notifDeletedRecipe($conn, $data["to"]);
}

echo json_encode([
    "success" => $result
]);