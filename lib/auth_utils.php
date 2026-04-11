<?php
    require_once(__DIR__ . '/../crud/user.crud.php');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    function logout($conn){
        setUserInactive($conn, $_SESSION['id']);
        unset($_SESSION['time']);
        unset($_SESSION['id']);
        unset($_SESSION['role']);
    }

    function tokenExpired(){
        //Vérifie si la connexion a dépassé les 30 minutes
        $res = false;
        if(isset($_SESSION['time'])){
            if(time()-$_SESSION['time'] > 1800){
                $res = true;
                logout();
            }
        }
        return $res;
    }

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

?>