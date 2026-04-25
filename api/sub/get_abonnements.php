<?php
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../crud/abo.crud.php');

    if(isset($_GET['id']) && isset($_GET['action'])){
        $action = $_GET['action'];
        $id = $_GET['id'];
        if($action == 'nbAbo'){
            $res = getNbAbonnements($conn, $id);
            $resultat = ['nb_abo' => $res];
            echo(json_encode($resultat));
        }else if($action == 'abonnements'){
            $res = getAbonnementsUser($conn, $id);
            $response = [];
            foreach($res as $user){
                $info = getUserById($conn, $user['account_id']);
                $infos = $info[0];
                $user_info = ["nom" => $infos['nom'], "prenom" => $infos['prenom'], "id" => $infos['id']];
                $response[] = $user_info;
            }
            echo(json_encode($response));
        }
    }
?>