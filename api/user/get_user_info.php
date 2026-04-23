<?php
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../crud/user.crud.php');
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $res = getUserById($conn, $id);
        $resultat = $res[0];
        echo(json_encode($resultat));
    }

    require_once(__DIR__ . '/../../db/db_disconnect.php');
?>