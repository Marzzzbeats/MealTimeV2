<?php
    require_once(__DIR__ . '/../lib/user_utils.php');

    function getRecettesFav($conn, $user_id){
        //Récupère les recettes favorites du user entré en paramètres
        $sql = "SELECT * FROM favoris JOIN recettes ON favoris.recette_id = recettes.id JOIN relation_recette_ingredient ON recettes.id = relation_recette_ingredient.id_recettes JOIN ingredients ON relation_recette_ingredient.id_ingredient = ingredients.id WHERE favoris.user_id = $user_id";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }

    function deleteRecetteFav($conn, $recette_id, $user_id){
        //Retire une recette des favoris du user
        $sql = "DELETE FROM favoris WHERE recette_id = $recette_id AND user_id = $user_id";
        $res = mysqli_query($conn, $sql);
        return $res;
    }

    function addRecetteFav($conn, $user_id, $recette_id){
        //Ajoute une recette en favoris
        $sql = "INSERT INTO favoris (`user_id`, `recette_id`) VALUES ('$user_id', '$recette_id')";
        echo($sql);
        $res = mysqli_query($conn, $sql);
        return $res;
    }
?>