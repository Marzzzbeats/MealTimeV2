<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    include __DIR__ . '/../db/db_connect.php';
    include __DIR__ . '/../db/db_connect.php';
    require_once __DIR__ . '/../crud/user.crud.php';
    require_once __DIR__ . '/../lib/login_utils.php';
    require_once __DIR__ . '/../lib/user_utils.php';
    require_once __DIR__ . '/../lib/register_utils.php';
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
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            $profile_pic = ""; // Valeur par défaut (vide)
            if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
                // L'utilisateur a uploadé une image !
                // (Ici vous mettriez votre code pour déplacer le fichier avec move_uploaded_file)
                $profile_pic = $_FILES['profile_pic']['name']; 
            }
            if(!pwordOk($password1, $password2)){
                header('Location: ./register.php?status=pwordNok');
            }else{
                $res = addUser($conn, $email, $nom, $prenom, $password1, $profile_pic);
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