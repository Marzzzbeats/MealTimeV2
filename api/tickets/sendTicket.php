<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include __DIR__ . "/../../db/db_connect.php"; 
    include __DIR__ . "/../../crud/tickets.crud.php"; 
    
    header('Content-Type: application/json');

?>

<?php

    $data = json_decode(file_get_contents("php://input"), true);

    $user_id = $data["user_id"];
    $category = $data["category"];
    $title = $data["title"];
    $message = $data["message"];
    $date = $data["date"];

    $result = addTicket($conn, $user_id, $category, $title, $message, $date);

    echo json_encode(["success" => $result]);

?>