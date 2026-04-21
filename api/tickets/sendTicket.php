<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include "/home/perivolas/public_html/mealtime/db/db_connect.php";
    include "/home/perivolas/public_html/mealtime/crud/tickets.crud.php";

    $conn = connection();
    
    header('Content-Type: application/json');

?>

<?php

    $data = json_decode(file_get_contents("php://input"), true);

    $user_id = $data["user_id"];
    $category = $data["category"];
    $title = $data["title"];
    $message = $data["message"];

    $result = addTicket($conn, $user_id, $category, $title, $message);

    echo json_encode(["success" => $result]);

?>