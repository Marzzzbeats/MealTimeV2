<?php
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../crud/abo.crud.php');
    require_once(__DIR__ . '/../notifs/sendNotifs.php');
    
    if(isset($_GET['id']) && isset($_GET['account_id']) && isset($_GET['action']) && isset($_GET['recette_id'])){
        $id = $_GET['id'];
        $action = $_GET['action'];
        $account_id = $_GET['account_id'];
        $recette_id = $_GET['recette_id'];
        if($action == 'addAbo'){
            $res = addAbo($conn, $id, $account_id);
            $url = "https://l1.dptinfo-usmb.fr/~grp9/api/notifs/sendNotifs.php?type=followRequest";
            $data = [
                "user_id" => $id,
                "owner" => $account_id
            ];
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true); // Montre que c'est un POST
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]); //header
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //Contenu de la requette
            $response = curl_exec($ch);
            if(curl_errno($ch)){
                echo 'Erreur : ' . curl_error($ch);
            }
            curl_close($ch);
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