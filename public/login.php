<?php
    session_start();
    include '../db/db_connect.php';
    include '../crud/user.crud.php';
    include '../lib/login_utils.php';
    include '../lib/user_utils.php';
?>

<?php
    //Contrôleurs GET

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
       $form = htmlLoginForm();
       echo($form); 
    ?>
    <?php
        //Controleur POST

        if(isset($_POST['action'])){
            $action=$_POST['action'];
            if($action == 'login'){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $is_user = checkUser($conn, $email, $password);
                if($is_user){
                    $user = getUserByEmail($conn, $email);
                    $id = $user['id'];
                    $role = $user['role'];
                    $_SESSION['time']=time();
                    $_SESSION['id']=$id;
                    $_SESSION['role']=$role;
                    $res=setUserActive($conn, $id);
                    if($res){
                        header("Loccation: index.php?status=loginSuccess");
                    }else{
                        header("Location: login.php?status=bddEfr");
                    }
                }
            }
        }
    ?>

    <p>Pas encore de compte ? <a href="./register.php">S'inscrire</a></p>

</body>
</html>

<?php
    include '../db/db_disconnect.php';
?>