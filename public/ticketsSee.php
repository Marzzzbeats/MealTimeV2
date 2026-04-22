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

    <link rel="stylesheet" href="./css/reset.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/tickets.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/navbar.css?v=<?php echo time(); ?>">

</head>
<body>
    <header>
        <h1>Les tickets utilisateurs</h1>
        <select id="filter_category"></select>
    </header>
    <ul id="tickets_ul"></ul>
    <ul id="navbar_ul">
        <li><a href="./profil.php">Profil</a></li>
        <li><a href="./recettes.php">Favoris</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="./semaine.php">Semaine</a></li>
        <li class="selected"><a href="./ticketsMake.php">Tickets</a></li>
    </ul>
</body>
</html>