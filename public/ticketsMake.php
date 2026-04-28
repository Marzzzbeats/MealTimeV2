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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unkempt&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./css/reset.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/roots.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/searchbar.css?v=<?php echo time(); ?>">
    <title>Tickets</title>

    <script src="./js/ticketsMake.js?v=<?php echo time(); ?>" defer></script>

    <link rel="stylesheet" href="./css/ticketsMake.css?v=<?php echo time(); ?>">

</head>
<body>
    <div id="container"></div>
    <ul id="navbar_ul">
        <li><a href="./account.php">Profil</a></li>
        <li><a href="./recettes.php">Mes recettes</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="./semaine.php">Ma semaine</a></li>
        <li class="selected"><a href="./ticketsMake.php">Support</a></li>
    </ul>
</body>
</html>