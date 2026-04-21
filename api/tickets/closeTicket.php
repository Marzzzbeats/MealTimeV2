<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include "/home/perivolas/public_html/mealtime/db/db_connect.php"; 
    include "/home/perivolas/public_html/mealtime/crud/tickets.crud.php"; 

    $conn = connection();


    header('Content-Type: application/json');

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
    deleteTicket($conn, $id);

    echo json_encode(["success" => true, "id" => $id]);

?>