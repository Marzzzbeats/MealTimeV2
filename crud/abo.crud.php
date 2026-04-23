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

    function getAboUser($conn, $user){
        $sql = "SELECT user_id FROM relation_user_abonnement WHERE account_id=$user";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }

    function getNbAbo($conn, $user){
        $abo = getAboUser($conn, $user);
        return count($abo);
    }
?>