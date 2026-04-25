<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../../crud/recettes.crud.php');
    require_once(__DIR__ . '/../../crud/favoris.crud.php');
    require_once(__DIR__ . '/../../db/db_connect.php');

    function groupRecettes($recettes) {
    $res = [];

    foreach ($recettes as $recette) {
        $id = $recette['id'];

        if (!isset($res[$id])) {
            $res[$id] = [
                'id_recette' => $id, 'owner' => $recette['owner'], 'saison' => $recette['saison'], 'price_ind' => $recette['price_ind'], 'health_ind' => $recette['health_ind'], 'titre' => $recette['titre'], 'description' => $recette['description'], 'upvote' => $recette['upvote'],'ing' => []];
        }
        if ($recette['ingredient_id'] !== null) {
            $res[$id]['ing'][] = ['id_ingredient' => $recette['ingredient_id'],'nom' => $recette['nom'],'quantite' => $recette['quantite']];
        }
    }

    return array_values($res);
}

    if(isset($_GET['action']) && $_GET['user_id']){
        $action = $_GET['action'];
        $user_id = $_GET['user_id'];
        if ($action == 'fav') {
            $recettes = getRecettesFav($conn, $user_id);
            echo json_encode(groupRecettes($recettes));
            exit;
        }
        if ($action == 'created') {
            $recettes = getRecettesByOwner($conn, $user_id);
            echo json_encode(groupRecettes($recettes));
            exit;
        }
    }


?>