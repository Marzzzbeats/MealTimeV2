<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // include "/home/perivolas/public_html/mealtime/lib/notifsAffichage.php";     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>

    <script src="/~perivolas/mealtime/public/js/ticketsMake.js?v=2" defer></script>

    <link rel="stylesheet" href="../css/tickets.css?v=4">
    <link rel="stylesheet" href="../css/navbar.css?v=4">
    <link rel="stylesheet" href="../css/roots.css?v=4">
    <link rel="stylesheet" href="../css/reset.css?v=4">

</head>
<body>
    <div id="container"></div>
    <ul>
        <li><a href="profil.php">Profil</a></li>
        <li><a href="recettes.php">Favoris</a></li>
        <li><a href="../../index.php">Accueil</a></li>
        <li><a href="semaine.php">Semaine</a></li>
        <li><a href="ticketsMake.php" id="ticketsLink">Tickets</a></li>
    </ul>
</body>
</html>