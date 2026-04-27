<?php
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../crud/favoris.crud.php');
    require_once(__DIR__ . '/../../crud/semaine.crud.php');
    require_once(__DIR__ . '/../../crud/recettes.crud.php');
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');


    header("Content-Type: application/json");

    $recettes = json_decode($_GET['recettes']);
    $semaine = json_decode($_GET['semaine']);

    $semaine = $semaine[0] ?? null;
    $tableau_nom_recettes = [];
    for ($i = 1; $i <= 14; $i++) {
        $id = $semaine["id_plat_$i"];
        $recette = getRecetteById($conn, $id)['titre'];
        $tableau_nom_recettes[] = $recette;
    }
    echo(json_encode($tableau_nom_recettes));
    
?>