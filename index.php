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
        <?php
        if(isset($_SESSION['id'])){
            $user_id = $_SESSION['id'];
            echo("<img id='pdp_img' src='https://l1.dptinfo-usmb.fr/~grp9/api/user/getProfilePic.php?id=$user_id' alt='pdp'>");
        }else{
            echo("<img id='pdp_img' src='./public/img/photodeprofil.jpg' alt='pdp'>");   
        }
        ?>
        <div id="pdp_menu">
            <div class="btn_log">
                <a href="./index.php?action=disconnect" id="logout" class="button hidden">Déconnexion</a>
            </div>

            <div class="btn_log">
                <a href="./public/login.php" id="login" class="button">Connexion</a>
                <a href="./public/register.php" id="register" class="button">S'inscrire</a>
            </div>
        </div>
    </div>
        
        
        <div id="logo">
            <img src="./public/img/LogoMeal.png" alt="logo">
        </div>
        
    <div id="header">
        <div id="SearchBar">
            <input type="text" placeholder="Poke bowl...">
            <input type="submit" value="Rechercher">
        </div>
    </div>
    
    <div id="container">
        <div id="searchResults" class="hidden"></div>
    </div>
    
    <ul id="navbar_ul">
        <?php
        if(isset($_SESSION['id'])){
            $user_id = $_SESSION['id'];
            echo("<li><a href='./public/account.php?user_id=$user_id'>Profil</a></li>");
        }
        ?>
        <li><a href="./public/recettes.php">Mes recettes</a></li>
        <li class="selected"><a href="./index.php">Accueil</a></li>
        <li><a href="./public/semaine.php">Ma semaine</a></li>
        <?php
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            if($role == 'admin'){
                echo('<li><a href="./public/ticketsSee.php" id="ticketsLink">Support</a></li>');
            }else{
                echo('<li><a href="./public/ticketsMake.php" id="ticketsLink">Support</a></li>');
            }
        }
        ?>
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