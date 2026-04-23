<?php
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../crud/abo.crud.php');
    require_once(__DIR__ . '/../../lib/abo_utils.php');
    
    if(isset($_GET['id']) && isset($_GET['account_id'])){
        $id = $_GET['id'];
        $account_id = $_GET['account_id'];
        $res = isAbo($conn, $id, $account_id);
        $resultat = ['result' => $res];
        echo(json_encode($resultat));
    }

    require_once(__DIR__ . '/../../db/db_disconnect.php');
?>