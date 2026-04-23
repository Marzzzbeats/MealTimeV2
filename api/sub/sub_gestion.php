<?php
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../crud/abo.crud.php');
    
    if(isset($_GET['id']) && isset($_GET['account_id']) && isset($_GET['action']) && isset($_GET['recette_id'])){
        $id = $_GET['id'];
        $action = $_GET['action'];
        $account_id = $_GET['account_id'];
        $recette_id = $_GET['recette_id'];
        if($action == 'addAbo'){
            $res = addAbo($conn, $id, $account_id);
            header("Location: https://l1.dptinfo-usmb.fr/~grp9/public/profil.php?owner=$account_id&id_recette=$recette_id");
            exit;
        }else if($action == 'delAbo'){
            $res = delAbo($conn, $id, $account_id);
            header("Location: https://l1.dptinfo-usmb.fr/~grp9/public/profil.php?owner=$account_id&id_recette=$recette_id");
            exit;
        }
    }

    require_once(__DIR__ . '/../../db/db_disconnect.php');
?>