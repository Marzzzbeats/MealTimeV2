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
    <ul>
        <li><a href="./public/login.php" id="login">Se connecter</a></li>
        <li><a href="./public/register.php" id="register">S'inscrire</a></li>
        <li><button id="logout" class="hidden"><a href="./index.php?action=disconnect">Se déconnecter</a></button></li>
    </ul>
</body>
</html>
<script src="./public/js/script_index.js"></script>
<link rel="stylesheet" href="./public/css/style.css"/>
<?php
    include './db/db_disconnect.php';
?>