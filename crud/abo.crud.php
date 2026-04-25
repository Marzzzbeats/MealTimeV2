<?php
    require_once(__DIR__ . '/../lib/user_utils.php');
    require_once(__DIR__ . '/../lib/auth_utils.php');

    function addAbo($conn, $user_id, $account_id){
        $sql = "INSERT INTO relation_user_abonnement (`user_id`, `account_id`) VALUES ($user_id, $account_id)";
        $res = mysqli_query($conn, $sql);
        return $res;
    }

    function delAbo($conn, $user_id, $account_id){
        $sql = "DELETE FROM relation_user_abonnement WHERE `user_id`=$user_id AND `account_id`=$account_id";
        $res = mysqli_query($conn, $sql);
        return $res;
    }

    function getAboUser($conn, $user_id){
        $sql = "SELECT user_id FROM relation_user_abonnement WHERE account_id=$user_id";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }

    function getNbAbo($conn, $user_id){
        $abo = getAboUser($conn, $user_id);
        return count($abo);
    }

    function getAbonnementsUser($conn, $user_id){
        $sql = "SELECT account_id FROM relation_user_abonnement WHERE user_id=$user_id";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }

    function getNbAbonnements($conn, $user_id){
        $abo = getAbonnementsUser($conn, $user_id);
        return count($abo);
    }
    
?>