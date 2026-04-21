<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    include __DIR__ . '/db/db_connect.php';
    include __DIR__ . '/lib/auth_utils.php';
?>

<?php

    if(isset($_GET['action'])){
        $action = $_GET['action'];
        if($action == 'disconnect'){
            logout($conn);
            header('Location: ./index.php');
        }else if($action == 'forbidden'){
            echo("<div class='alert'>Vous n'avez pas accès à cette page</div>");
        }
    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./public/css/reset.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./public/css/roots.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./public/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./public/css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./public/css/searchbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./public/css/notifs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./public/css/pdp.css?v=<?php echo time(); ?>">

    <title>MealTime</title>

    <script src="./public/js/script_index.js?v=<?php echo time(); ?>" defer></script>
    <script src="./public/js/notifs.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>
       
    <div id="pdp">
        <img id="pdp_img" src="./public/img/AvatarDef.png" alt="pdp">
        
        <div id="pdp_menu">
            <!-- <div class="btn_log">
                <a href="index.php?action=disconnect" id="logout" class="button">Déconnexion</a>
            </div> -->

            <div class="btn_log">
                <a href="./public/img/login.php" id="login" class="button">Connexion</a>
                <a href="./public/img/register.php" id="register" class="button">S'inscrire</a>
            </div>
        </div>
    </div>
        
        
        <div id="logo">
            <img src="./public/img/LogoMeal.png" alt="logo">
        </div>
        
    <div id="header">
        <div id="SearchBar">
            <input type="text" placeholder="Search..">
            <input type="submit" value="Search">
        </div>
    </div>
    
    <div id="container">
        <div id="searchResults" class="hidden"></div>
    </div>
    
    <ul>
        <li><a href="./public/html/profil.php">Profil</a></li>
        <li><a href="./public/html/recettes.php">Favoris</a></li>
        <li><a href="./index.php">Accueil</a></li>
        <li><a href="./public/html/semaine.php">Semaine</a></li>
        <li><a href="./public/html/ticketsMake.php" id="ticketsLink">Tickets</a></li>
    </ul>
 
    <div id="notifs_div">
        <div id="notifs_display_div" class="hidden">
            <p id="notif_p">NOTIFICATIONS</p>
    </div>
</body>
</html>
<script src="./public/js/script_index.js"></script>
<link rel="stylesheet" href="./public/css/style.css"/>
<?php
    include './db/db_disconnect.php';
?>