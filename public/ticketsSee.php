<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    session_start();

    // include "/home/perivolas/public_html/mealtime/lib/notifsAffichage.php";     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>

    <script src="./js/ticketsSee.js?v=3" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>

    <link rel="stylesheet" href="./css/tickets.css?v=3">

</head>
<body>
    <header>
        <h1>Les tickets utilisateurs</h1>
        <select id="filter_category"></select>
    </header>
    <ul id="tickets_ul"></ul>
</body>
</html>