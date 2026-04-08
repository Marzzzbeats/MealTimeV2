<?php
    session_sart();
    require_once('../crud/user.crud.php');
    require_once('../db/db_connect.php');

    function logout(){
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



?>