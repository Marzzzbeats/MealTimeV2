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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unkempt&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/recettes.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/rcp_form.css">
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
    <div>
        <h1>Binevenue chez MealTime !</h1>
        <img src="./img/LogoMeal.png" alt="Logo MealTime">
    </div>
    <div id='register_form' class='popup_form'></div>
    <?php
        if(isset($_POST['action'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0){
                    $tmp = $_FILES['profile_pic']['tmp_name']; 
                    $data = file_get_contents($tmp);
                }
                if(isset($data)){
                    $profile_pic = $data;
                }else{
                    $profile_pic = ""; 
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