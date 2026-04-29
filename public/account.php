<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../db/db_connect.php');
    require_once(__DIR__ . '/../views/account_views.php'); 
    require_once(__DIR__ . '/../crud/user.crud.php');
    require_once(__DIR__ . '/../lib/user_utils.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unkempt&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/reset.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/roots.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/rcp_form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/recettes.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/profil.css?v=<?php echo time(); ?>">

    <title>MealTime</title>
</head>
<body>
    <?php
        if(isset($_GET['status'])){
            $status = $_GET['status'];
            if($status == 'notValidEmail'){
                echo('<div class="alert">Cet email est déjà pris par un autre utilisateur</p>');
            }else if($status == 'mdpFalse'){
                echo("<div class='alert'>Mot de passe incorrect</p>");
            }
        }
    ?>
    <div id='div_nom_pp'></div>
    <div id='titre_info' class='rec'>
        <h2>Voici vos informations personnelles :</h2>
        <div id='infos' class='info_container'>

        </div>
    </div>

    <div class="screen hidden" id="modif_nom">
        <div class="popup_form">
            <?php
                echo(createHtmlModifNameForm($conn));
            ?>
        </div>
    </div>

    <div class="screen hidden" id="modif_email">
        <div class="popup_form">
            <?php
                echo(createHtmlModifEmailForm($conn));
            ?>
        </div>
    </div>

    <div class="screen hidden" id="modif_password">
        <div class="popup_form">
            <?php
                echo(createHtmlModifPasswordForm($conn));
            ?>
        </div>
    </div>

    <div class="screen hidden" id="modif_pp">
        <div class="popup_form">
            <?php
                echo(createHtmlModifPpForm($conn));
            ?>
        </div>
    </div>

    <?php
        //Gestion des formulaires

        if(isset($_POST['action'])){
            $id = $_SESSION['id'];
            $action = $_POST['action'];
            if($action == 'modif_name'){
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                modifNomUser($conn, $id, $nom, $prenom);
            }else if($action == 'modif_email'){
                $email = $_POST['email'];
                if(isOkEmail($email, $conn)){
                    modifEmailUser($conn, $id, $email);
                }else{
                    header("Location: https://l1.dptinfo-usmb.fr/~grp9/public/account.php?user_id=$id&status=notValidEmail");
                }
            }else if($action == 'modif_password'){
                $response = getPasswordUser($conn, $id);
                $user_pass = $response['password'];
                $password = $_POST['old_pass'];
                if(checkPassword($password, $user_pass)){
                    $new_pass = $_POST['new_pass'];
                    modifMdp($conn, $id, $new_pass);
                }else{
                    header("Location: https://l1.dptinfo-usmb.fr/~grp9/public/account.php?user_id=$id&status=mdpFalse");
                }
            }else if($action == 'modif_pp'){
                if(isset($_FILES['pp']) && $_FILES['pp']['error'] === 0){
                    $tmp = $_FILES['pp']['tmp_name']; 
                    $data = file_get_contents($tmp);
                }
                if(isset($data)){
                    $profile_pic = $data;
                }else{
                    $profile_pic = ""; 
                }
                modifPp($conn, $id, $profile_pic);
            }
        }

    ?>

    

    <div class="screen hidden" id="abonnements"></div>
    <div class="screen hidden" id="abonnes"></div>

    <ul id="navbar_ul">
        <li class="selected"><a href='./account.php'>Profil</a></li>
        <li><a href="./recettes.php">Mes recettes</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="./semaine.php">Ma semaine</a></li>
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

    <script src='./js/account.js'></script>
</body>