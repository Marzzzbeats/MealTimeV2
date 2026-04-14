<?php
    include './db/db_connect';
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
        <img src="images/Black-Screen.jpg" alt="blackscreen">
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
<?php
    include './db/db_disconnect';
?>