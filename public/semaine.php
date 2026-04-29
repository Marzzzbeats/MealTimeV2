<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unkempt&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/roots.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/semaine.css?v=2">

    <title>MA SEMAINE</title>

</head>
<body>
    <?php
        require_once(__DIR__ . '/../db/db_connect.php');
        require_once(__DIR__ . '/../crud/favoris.crud.php');
        require_once(__DIR__ . '/../crud/semaine.crud.php');
        require_once(__DIR__ . '/../crud/recettes.crud.php');
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $user_id = $_SESSION['id']; 
    ?>
    <script src="./js/semaine.js"></script>
   
    <form id="CreateSemaineForm"></form>

    <p id="Erreurs"></p>

    <div id='tableau'></div>
    
    
    <ul id="navbar_ul">
            <li><a href="./account.php">Profil</a></li>
            <li><a href="./recettes.php">Mes recettes</a></li>
            <li><a href="../index.php">Accueil</a></li>
            <li class="selected"><a href="./semaine.php">Ma semaine</a></li>
            <?php
                if(isset($_SESSION['role'])){
                    $role = $_SESSION['role'];
                    if($role == 'admin'){
                        echo('<li><a href="./ticketsSee.php" id="ticketsLink">Support</a></li>');
                    }else{
                        echo('<li><a href="./ticketsMake.php" id="ticketsLink">Support</a></li>');
                    }
                }
            ?>
    </ul>



</body>
</html>