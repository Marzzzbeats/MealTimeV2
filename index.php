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
        }
    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <img src="images/Black-Screen.jpg" alt="blackscreen">
        <a href="./public/login.php" id="login">Se connecter</a>
        <a href="./public/register.php" id="register">S'inscrire</a>
        <a href="index.php?action=disconnect" id="logout" class="hidden">Se déconnecter</a>
    </div>

    <!-- <div class="logo">
        <img src="" alt="">
    </div> -->

    <form action="">
        <div id="SearchBar">
            <input type="text" placeholder="Search..">
            <input type="submit" value="Search">
        </div>
    </form>

    <nav>
        <ul>
            <li><a href="./profil.php">Profil</a></li>
            <li><a href="./favoris.php">Favoris</a></li>
            <li><a href="./index.php">Accueil</a></li>
            <li><a href="./semaine.php">Semaine</a></li>
            <li><a href="./tickets.php">Tickets</a></li>
        </ul>
    </nav>
</body>
</html>
<script src="./public/js/script_index.js"></script>
<link rel="stylesheet" href="./public/css/style.css"/>
<?php
    include './db/db_disconnect.php';
?>