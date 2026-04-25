<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../db/db_connect.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/recettes.css">
    <link rel="stylesheet" href="./css/profil.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/searchbar.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/roots.css">
    <title>MealTime</title>
</head>
<body>
    <div id='div_nom_pp'></div>
    <div class='rec'>
        <div id='user_recettes'></div>
        <div id="created" class='fl-row-recette'></div>
    </div>

    <ul id="navbar_ul">
        <li><a href="./account.php">Profil</a></li>
        <li><a href="./recettes.php">Mes recettes</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="./semaine.php">Ma semaine</a></li>
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
    <script src='./js/profil.js'></script>
</body>
</html>
<?php
    require_once(__DIR__ .  '/../db/db_disconnect.php');
?>