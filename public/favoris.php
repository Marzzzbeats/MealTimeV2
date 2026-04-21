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
        <ul>
            <li><a href="./profil.php">Profil</a></li>
            <li class="selected"><a href="./favoris.php">Favoris</a></li>
            <li><a href="./index.php">Accueil</a></li>
            <li><a href="./semaine.php">Semaine</a></li>
            <li><a href="./tickets.php">Tickets</a></li>
        </ul>
</body>
</html>
<?php
    include './db/db_disconnect';
?>