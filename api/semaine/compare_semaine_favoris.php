<?php
    require_once(__DIR__ . '/../../db/db_connect.php');
    require_once(__DIR__ . '/../../crud/favoris.crud.php');
    require_once(__DIR__ . '/../../crud/semaine.crud.php');
    require_once(__DIR__ . '/../../crud/recettes.crud.php');
    require_once(__DIR__ . '../get_semaine_id.php');
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');


    header("Content-Type: application/json");

    $recettes = json_decode($_GET['recettes']);
    $semaine = json_decode($_GET['semaine']);


    function get_semaine_id($conn, $semaine, $recettes){
            $semaine = $semaine[0] ?? null;
            $tableau_id_recettes = [];
            for ($i = 1; $i <= 14; $i++) {
                $id = $semaine["id_plat_$i"];
                $tableau_id_recettes[] = $id;
            }
            return $tableau_id_recettes;
        }

    function trouve_dans_favoris($id_de_la_recette, $recettes){
            $trouve = FALSE;
            $i = 0; 
            while ($i < count($recettes) && (!$trouve)) {
                if ($id_de_la_recette == $recettes[$i]['recette_id']){
                    $trouve = TRUE;
                }
                $i++;
            }
            return $trouve;
        }


    $res = TRUE;
    $semaine = get_semaine_id($conn, $semaine, $recettes);
    for ($i = 0; $i < 14; $i++) {
        $id_de_la_recette = $semaine[$i];
        if (!trouve_dans_favoris($id_de_la_recette, $recettes)){
            $res = FALSE;
        }
    }
    echo(json_encode($res));


?>