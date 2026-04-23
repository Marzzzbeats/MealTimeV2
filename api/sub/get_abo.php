<?php
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../crud/abo.crud.php');
    
    if(isset($_GET['id']) && isset($_GET['action'])){
        $id = $_GET['id'];
        $action = $_GET['action'];
        if($action == 'nbAbo'){
            $res = getNbAbo($conn, $id);
            $resultat = ['nb_abo' => $res];
            echo(json_encode($resultat));
        }
    }

    require_once(__DIR__ . '/../../db/db_disconnect.php');
?>