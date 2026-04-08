<?php
    session_start();
    include '../db/db_connect.php';
    include '../db/db_connect.php';
    require_once '../crud/user.crud.php';
    require_once '../lib/login_utils.php';
    require_once '../lib/user_utils.php';
?>

<?php
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        if($status == 'pwordNok'){
            echo('<div class="alert"><p>Les deux mots de passes entrés sont différents</p></div>');
        }else if($status == 'bddErr'){
            echo('<div class="alert"><p>Les informations que vous avez entrées ne sont pas valides</p></div>');
        }
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

</head>
<body>
    <div id='register_form'></div>
    <p>Déjà membre ? <a href="./login.php">Se connecter</a></p>
    <?php
        if(isset($_POST['action'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $profile_pic = $_POST['profile_pic'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            if(!pwordOk($password1, $password2)){
                header('Location: ./register.php?status=pwordNok');
            }else{
                $res = addUser($conn, $email, $nom, $prenom, $password1, $profile_pic, null, null, null);
                if(!$res){
                    header('Location: ./register.php?status=bddErr');
                }else{
                    header('Location: ./login.php?status=success');
                }
            }
        }
    ?>
</body>
</html>
<script src="./js/register.js"></script>

<?php
    include '../db/db_disconnect.php';
?>