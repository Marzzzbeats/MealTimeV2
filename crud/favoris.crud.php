<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../lib/user_utils.php');

    function getRecettesFav($conn, $user_id){
        //Récupère les recettes favorites du user entré en paramètres
        $sql = "SELECT * FROM favoris JOIN recettes ON favoris.recette_id = recettes.id JOIN relation_recette_ingredient ON recettes.id = relation_recette_ingredient.id_recette JOIN ingredients ON relation_recette_ingredient.id_ingredient = ingredients.id WHERE favoris.user_id = $user_id ORDER BY recettes.id, relation_recette_ingredient.id_ingredient";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }
    
    function getRecettesFavoris($conn, $user_id){
        //Récupère les recettes favorites du user entré en paramètres
        $sql = "SELECT favoris.user_id, favoris.recette_id, recettes.id, recettes.owner, recettes.saison, recettes.price_ind, recettes.health_ind, recettes.titre, recettes.description, recettes.upvote FROM favoris JOIN recettes ON favoris.recette_id = recettes.id WHERE favoris.user_id = $user_id ORDER BY recettes.id ";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }

    function getRecettesFavFormat($conn, $user_id){
        $res = array();
        $fav = getRecettesFav($conn, $user_id);
        $created = array();
        $tab = array();
        $current_id = $fav[0]['id_recette'];
        $created['id_recette']=$fav[0]['id_recette'];
        $created['owner'] = $fav[0]['owner'];
        $created['saison'] = $fav[0]['saison'];
        $created['price_ind'] = $fav[0]['price_ind'];
        $created['health_ind'] = $fav[0]['health_ind'];
        $created['titre'] = $fav[0]['titre'];
        $created['description'] = $fav[0]['description'];
        $created['upvote'] = $fav[0]['upvote'];
            foreach($fav as $created_res){
                if($created_res['id_recette'] != $current_id){
                    $created['ing'] = $tab;
                    $res[] = $created;
                    $created = [];
                    $tab = [];
                    $current_id = $created_res['id_recette'];
                    $created['id_recette']=$created_res['id_recette'];
                    $created['owner'] = $created_res['owner'];
                    $created['saison'] = $created_res['saison'];
                    $created['price_ind'] = $created_res['price_ind'];
                    $created['health_ind'] = $created_res['health_ind'];
                    $created['titre'] = $created_res['titre'];
                    $created['description'] = $created_res['description'];
                    $created['upvote'] = $created_res['upvote'];
                }else{
                    $row = ['id_ingredient' => $created_res['id_ingredient'], 'quantite' => $created_res['quantite'], 'nom' => $created_res['nom']];
                    $tab[] = $row;
                }
            }
        $created['ing'] = $tab;
        $res[] = $created;
        return $res;
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
        $res = mysqli_query($conn, $sql);
        return $res;
    }

    function getRecettesFavorisFormat($conn, $user_id){
        $res = array();
        $fav = getRecettesFavoris($conn, $user_id);
        $created = array();
        $tab = array();
        $current_id = $fav[0]['id_recette'];
        $created['id_recette']=$fav[0]['id_recette'];
        $created['owner'] = $fav[0]['owner'];
        $created['saison'] = $fav[0]['saison'];
        $created['price_ind'] = $fav[0]['price_ind'];
        $created['health_ind'] = $fav[0]['health_ind'];
        $created['titre'] = $fav[0]['titre'];
        $created['description'] = $fav[0]['description'];
        $created['upvote'] = $fav[0]['upvote'];
            foreach($fav as $created_res){
                if($created_res['id_recette'] != $current_id){
                    $created['ing'] = $tab;
                    $res[] = $created;
                    $created = [];
                    $tab = [];
                    $current_id = $created_res['id_recette'];
                    $created['id_recette']=$created_res['id_recette'];
                    $created['owner'] = $created_res['owner'];
                    $created['saison'] = $created_res['saison'];
                    $created['price_ind'] = $created_res['price_ind'];
                    $created['health_ind'] = $created_res['health_ind'];
                    $created['titre'] = $created_res['titre'];
                    $created['description'] = $created_res['description'];
                    $created['upvote'] = $created_res['upvote'];
                }
            }
        $created['ing'] = $tab;
        $res[] = $created;
        return $res;
    }
?>