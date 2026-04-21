<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    include __DIR__ . '/../../db/db_connect.php';
    require_once(__DIR__ . '/../../crud/user.crud.php');
    require_once __DIR__ . '/../../lib/login_utils.php';
    require_once __DIR__ . '/../../lib/user_utils.php';
?>

<?php
    //Contrôleurs GET
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        if($status == 'bddErr'){
            echo("<div class='alert'><p>Erreur dans la base de donnée, veuillez réeessayer ulterieurement</p></div>");
        }elseif($status == 'userNull'){
            echo("<div class='alert'><p>Cet utilisateur n'existe pas</p></div>");
        }elseif($status == 'pwdFalse'){
            echo("<div class='alert'><p>Mauvais mot de passe</p></div>");
        }elseif($status == 'success'){
            echo('<div class="alert"><p>Utilisateur enregistré avec succès. Connectez vous dès à présent</p></div>');
        }elseif($status == 'disconnected'){
            echo('<div class="alert"><p>Veuillez vous connecter pour accèder à vos pages personnelles</p></div>');   
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div id='login_form'></div>
    <?php
        //Controleur POST

        if(isset($_POST['action'])){
            $action=$_POST['action'];
            if($action == 'login'){
                $email = $_POST['email'];
                $password = trim($_POST['password']);
                $is_user = isUser($conn, $email, $password);
                if($is_user){
                    $user = getUserByEmail($conn, $email);
                    $id = $user['id'];
                    $role = $user['role'];
                    $_SESSION['time']=time();
                    $_SESSION['id']=$id;
                    $_SESSION['role']=$role;
                    $res=setUserActive($conn, $id);
                    if($res){
                        header("Location: ../../index.php?status=loginSuccess");
                    }else{
                        header("Location: login.php?status=bddErr");
                    }
                }
            }
        }
    ?>

    <p>Pas encore de compte ? <a href="./register.php">S'inscrire</a></p>

</body>
</html>

<?php
    // include '/../../db/db_disconnect.php';
?>
<script src="../js/login.js"></script>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/recettes.css">