<?php
    include "/home/perivolas/public_html/mealtime/db/db_connect.php";
    include "/home/perivolas/public_html/mealtime/crud/tickets.crud.php";

    header('Content-Type: application/json');

    session_start();

    $conn = connection();

    $tickets = getAllTickets($conn);
    echo (json_encode($tickets));
?>