<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include __DIR__ . "/../../db/db_connect.php"; 
    include __DIR__ . "/../../crud/notifs.crud.php"; 

    $conn = connection();

?>

<?php

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        exit;
    }

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing id"]);
        exit;
    }

    $id = $data['id'];
    markAsRead($conn, $id);

    echo json_encode(["success" => true, "id" => $id]);

?>