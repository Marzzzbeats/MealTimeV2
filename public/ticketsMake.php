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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/roots.css">
    <title>Tickets</title>

    <script src="./js/ticketsMake.js?v=2" defer></script>

    <link rel="stylesheet" href="./css/tickets.css?v=4">

</head>
<body>
    <div id="container"></div>
    <ul>
        <li><a href="./profil.php">Profil</a></li>
        <li><a href="./recettes.php">Favoris</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="./semaine.php">Semaine</a></li>
        <li class="selected"><a href="./ticketsMake.php">Tickets</a></li>
    </ul>
</body>
</html>