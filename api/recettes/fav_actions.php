<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../../crud/favoris.crud.php');
    require_once(__DIR__ . '/../../crud/recettes.crud.php');
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../lib/fav_utils.php');

    if(isset($_GET['id_user']) && isset($_GET['action']) && isset($_GET['id_recette'])){
        $action = $_GET['action'];
        $user_id = $_GET['id_user'];
        $recette_id = $_GET['id_recette'];
        if($action == 'delete'){
            deleteRecette($conn, $recette_id);
            header('Location: ../../public/recettes.php?status=delSuccess');
        }else if($action == 'addFav'){
            addRecetteFav($conn, $user_id, $recette_id);
            addUpVote($conn, $recette_id);
            header('Location: ../../public/recettes.php?status=addSuccess');
        }else if($action == 'remFav'){
            deleteRecetteFav($conn, $recette_id, $user_id,);
            delUpVote($conn, $recette_id);
            header('Location: ../../public/recettes.php?status=delFavSuccess');
        }else if($action == 'isFav'){
            $res = isFav($conn, $user_id, $recette_id);
            $tab = [];
            $tab['fav'] = $res;
            echo(json_encode($tab));
        }

    }


    require_once(__DIR__ . '/../../db/db_disconnect.php');
?>