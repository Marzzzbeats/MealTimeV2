<?php
    require_once(__DIR__ . '/../crud/abo.crud.php');

    function isAbo($conn, $user_id, $account_id){
        $res = false;
        $abos = getAboUser($conn, $account_id);
        foreach($abos as $abo){
            if($abo['user_id'] == $user_id){
                $res = true;
            }
        }
        return $res;
    }
?>