<?php
    // include './db/db_connect';
?>

<?php
    // session_start();
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');
?>

<?php

    // if(isset($_GET['action'])){
    //     $action = $_GET['action'];
    //     if($action == 'disconnect'){
    //         logout($conn);
    //         header('Location: ./index.php');
    //     }
    // }

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
    <title>MealTime</title>
</head>
<body>
    <?php
        /* Table des gestions d'erreurs (à implementer dans les contrôleurs GET):
        status=connError : Erreur de connexion à la base
        status=userErr1 : Impossible de récuperer les utilisateurs dans user
        status=userErr2 : Impossible de récuperer le user avec l'id $id
        status=userErr3 : Impossible de créer le user
        status=userErr4 : Impossible de supprimer le user avec l'id $id
        status=userErr5 : Impossible de modifier le user avec l'id $id
            */
    ?>
    
    <div id="profil">
        <img src="images/photodeprofil.jpg" alt="pdp">
        <a href="./public/login.php" id="login" class="hidden">Se connecter</a>
        <a href="./public/register.php" id="register" class="hidden">S'inscrire</a>
        <a href="index.php?action=disconnect" id="logout"><img src="images/logout.png" alt="logout"></a>
    </div>
    </div>

    <div id="logo">
        <img src="images/Black-Screen.jpg" alt="logo">
    </div>

    <div id="header">
        <div id="SearchBar">
            <input type="text" placeholder="Search..">
            <input type="submit" value="Search">
        </div>
    </div>

    <div id="container">

    </div>
        <ul>
            <li><a href="./profil.php">Profil</a></li>
            <li><a href="./favoris.php">Favoris</a></li>
            <li class="selected"><a href="./index.php">Accueil</a></li>
            <li><a href="./semaine.php">Semaine</a></li>
            <li><a href="./tickets.php">Tickets</a></li>
        </ul>
</body>
</html>
<?php
    include './db/db_disconnect';
?>