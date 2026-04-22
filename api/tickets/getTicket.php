<?php
    include __DIR__ . "/../../db/db_connect.php"; 
    include __DIR__ . "/../../crud/tickets.crud.php"; 

    header('Content-Type: application/json');

    session_start();

    $tickets = getAllTickets($conn);
    echo (json_encode($tickets));
?>