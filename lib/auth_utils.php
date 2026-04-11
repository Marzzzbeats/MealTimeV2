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

    echo("<p>ok</p>");

?>