<?php
    //API Pour récuperer les recettes d'un utilisateur
    require_once(__DIR__ . '/../crud/recettes.crud.php');
    require_once(__DIR__ . '/../crud/favoris.crud.php');
    require_once(__DIR__ . '/../db/db_connect.php');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    if(isset($_GET['action']) && isset($_GET['user_id'])){
        $action = $_GET['action'];
        $user_id = $_GET['user_id'];
        if($action == 'fav'){
            $fav = getRecettesFav($conn, $user_id);
            echo(json_encode($fav));
        }elseif($action == 'created'){
            $created = getRecetteByOwner($conn, $user_id);
            echo(json_encode($created));
        }
    }

    require_once(__DIR__ . '/../db/db_disconnect.php');
?>