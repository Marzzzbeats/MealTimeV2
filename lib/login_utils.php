<?php
    include '../crud/user.crud.php';
    include './user_utils.php';

    function ashPassword($clear_password){
        //Chiffre le mot de passe afin de ne pas le stocker en clair dans la bdd
        $ash_pass = password_hash($clear_password, PASSWORD_DEFAULT);
        return $ash_pass;
    }

    function checkPassword($pass, $ashed_pass){
        //Vérifie si le mot de passe correspond bien au ash du mdp
        $res=password_verify($pass, $ashed_pass);
        return $res;
    }
    
    function isUser($conn, $email, $password){
        //Vérifie si un user existe bien
        $res=false
        $user = getUserById($conn, $email);

        if($user == []){
            header('Location: public/login.php?status=userNull');
        }else{
            $pwd_ok = checkPassword($password, $user['password']);

            if(!$pwd_ok){
                header('Location: public/login.php?status=pwdFalse');
            }else{
                $res=true;
            }
        }
        return $res;
    }


?>