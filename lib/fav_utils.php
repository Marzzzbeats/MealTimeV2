<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../crud/favoris.crud.php');

    function isFav($conn, $user_id, $recette_id){
        $recettes_fav = getIdRecettesFav($conn, $user_id);
        $res = false;
        foreach($recettes_fav as $recette){
            $id = $recette['recette_id'];
            if($id == $recette_id){
                $res = true;
            }
        }
        return $res;
    }

?>