<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include __DIR__ . "/../../db/db_connect.php"; 
    include __DIR__ . "/../../crud/notifs.crud.php"; 

    
    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];
    markAsRead($conn, $id);

    echo json_encode(["success" => true, "id" => $id]);

?>