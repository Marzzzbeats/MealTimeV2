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
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/navbar.css">
    <link rel="stylesheet" href="./public/css/searchbar.css">
    <link rel="stylesheet" href="./public/css/reset.css">
    <link rel="stylesheet" href="./public/css/roots.css">
    <link rel="stylesheet" href="./public/css/boutonpdp.css">
    <title>MealTime</title>
</head>
<body>
    
    <div class="btn_log">
        <img src="./public/img/AvatarDef.png" alt="pdp">
        <a href="./index.php?action=disconnect" id="logout" class="button hidden">Déconnexion</a>
        <a href="./public/login.php" id="login" class="button">Connexion</a>
        <a href="./public/register.php" id="register" class="button">S'inscrire</a>
    </div>


    <div id="logo">
        <img src="./public/img/LogoMeal.png" alt="logo">
    </div>

    <div id="header">
        <div id="SearchBar">
            <form action="index.php" method="POST">
                <input type="text" placeholder="Search..">
                <input type="submit" value="Search">
            </form>
        </div>
    </div>

    <div id="container">

    </div>
        <ul>
            <li><a href="./profil.php">Profil</a></li>
            <li><a href="./public/recettes.php">Favoris</a></li>
            <li class="selected"><a href="./index.php">Accueil</a></li>
            <li><a href="./public/semaine.php">Semaine</a></li>
            <?php
                if(isset($_SESSION['role'])){
                    $role = $_SESSION['role'];
                    if($role == 'admin'){
                        echo('<li><a href="./public/ticketsSee.php">Tickets</a></li>');
                    }else{
                        echo('<li><a href="./public/ticketsMake.php">Tickets</a></li>');
                    }
                }else{
                    echo('<li><a href="./public/ticketsMake.php">Tickets</a></li>');
                }
            ?>
        </ul>
</body>
</html>
<script src="./public/js/script_index.js"></script>
<link rel="stylesheet" href="./public/css/style.css"/>
<?php
    include './db/db_disconnect.php';
?>