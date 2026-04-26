<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../db/db_connect.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/recettes.css">
    <link rel="stylesheet" href="./css/profil.css">
    <link rel="stylesheet" href="./css/reset.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/roots.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/searchbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/notifs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/pdp.css?v=<?php echo time(); ?>">

    <title>MealTime</title>
</head>
<body>

    <div id='div_nom_pp'></div>
    <div id='titre_info' class='rec'>
        <div id='infos' class='info_container'>

        </div>
    </div>


    <ul id="navbar_ul">
        <li class="selected"><a href='./account.php'>Profil</a></li>
        <li><a href="./recettes.php">Mes recettes</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="./semaine.php">Ma semaine</a></li>
        <?php
            if(isset($_SESSION['role'])){
                $role = $_SESSION['role'];
                if($role == 'admin'){
                    echo('<li><a href="./ticketsSee.php" id="ticketsLink">Support</a></li>');
                }else{
                    echo('<li><a href="./ticketsMake.php" id="ticketsLink">Support</a></li>');
                }
            }
        ?>
    </ul>

    <script src='./js/account.js'></script>
</body>