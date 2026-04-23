<?php
    require_once(__DIR__ . '/../db/db_connect');
    session_start();
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
        <ul id="navbar_ul">
            <li class="selected"><a href="./profil.php">Profil</a></li>
            <li><a href="./recettes.php">Favoris</a></li>
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="./semaine.php">Semaine</a></li>
            <?php
                if(isset($_SESSION['role'])){
                    $role = $_SESSION['role'];
                    if($role == 'admin'){
                        echo('<li><a href="./ticketsSee.php" id="ticketsLink">Tickets</a></li>');
                    }else{
                        echo('<li><a href="./ticketsMake.php" id="ticketsLink">Tickets</a></li>');
                    }
                }
            ?>
        </ul>
</body>
</html>
<?php
    include './db/db_disconnect';
?>