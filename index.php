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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unkempt&display=swap" rel="stylesheet">
    
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
        <div id="pdp_img_wrapper">    
            <?php
                if(isset($_SESSION['id'])){
                    $user_id = $_SESSION['id'];
                    echo("<img id='pdp_img' src='https://l1.dptinfo-usmb.fr/~grp9/api/user/getProfilePic.php?id=$user_id' alt='pdp'>");
                }else{
                    echo("<img id='pdp_img' src='./public/img/AvatarDef.png' alt='pdp'>");   
                }
            ?>
        </div>
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
            <input type="text" placeholder="Search..">
            <svg id="search_svg" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
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
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z"/></svg>
        <div id="notifs_display_div" class="hidden">
            <p id="notif_p">NOTIFICATIONS</p>

    </div>
</body>
</html>
<?php
    include './db/db_disconnect.php';
?>