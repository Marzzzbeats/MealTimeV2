<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../lib/user_utils.php');

    function getRecettesFav($conn, $user_id){
        $sql = "
            SELECT 
                r.id AS id,
                r.owner,
                r.saison,
                r.price_ind,
                r.health_ind,
                r.titre,
                r.description,
                r.upvote,
                i.id AS ingredient_id,
                i.nom,
                ri.quantite
            FROM favoris f
            JOIN recettes r 
                ON f.recette_id = r.id
            LEFT JOIN relation_recette_ingredient ri 
                ON r.id = ri.id_recette
            LEFT JOIN ingredients i 
                ON ri.id_ingredient = i.id
            WHERE f.user_id = ?
            ORDER BY r.id
        ";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);
        return rsToAssoc($res);
    }
    
    function getRecettesFavorisR($conn, $user_id){
        //Récupère les recettes favorites du user entré en paramètres
        $sql = "SELECT favoris.user_id, favoris.recette_id, recettes.id, recettes.owner, recettes.saison, recettes.price_ind, recettes.health_ind, recettes.titre, recettes.description, recettes.upvote FROM favoris JOIN recettes ON favoris.recette_id = recettes.id WHERE favoris.user_id = $user_id ORDER BY recettes.id ";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }
    
    function getRecettesFavoris($conn, $user_id, $saison, $prix, $sante){
        //Récupère les recettes favorites du user entré en paramètres
        $sql = "SELECT favoris.user_id, favoris.recette_id, recettes.id, recettes.owner, recettes.saison, recettes.price_ind, recettes.health_ind, recettes.titre, recettes.description, recettes.upvote FROM favoris JOIN recettes ON favoris.recette_id = recettes.id WHERE favoris.user_id = $user_id AND recettes.saison = '$saison' AND recettes.price_ind <= $prix AND recettes.health_ind >= $sante ORDER BY recettes.id";
        $res = mysqli_query($conn, $sql);
        if($res){
            $tab = rsToAssoc($res);
            return $tab;
        }
        return [];
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