<?php
    //API Pour récuperer les recettes d'un utilisateur
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../../crud/recettes.crud.php');
    require_once(__DIR__ . '/../../crud/favoris.crud.php');
    require_once(__DIR__ . '/../../db/db_connect.php');
    
    
    if(isset($_GET['action']) && isset($_GET['user_id'])){
        $action = $_GET['action'];
        $user_id = $_GET['user_id'];
        if($action == 'fav'){
            $res = array();
            $fav = getRecettesFav($conn, $user_id);
            if(count($fav) != 0){
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
            }
            echo(json_encode($res));
        }elseif($action == 'created'){
            $res = array();
            $created_tot = getRecettesByOwner($conn, $user_id);
            $created = array();
            $tab = array();
            $current_id = $created_tot[0]['id_recette'];
            $created['id_recette']=$created_tot[0]['id_recette'];
            $created['owner'] = $created_tot[0]['owner'];
            $created['saison'] = $created_tot[0]['saison'];
            $created['price_ind'] = $created_tot[0]['price_ind'];
            $created['health_ind'] = $created_tot[0]['health_ind'];
            $created['titre'] = $created_tot[0]['titre'];
            $created['description'] = $created_tot[0]['description'];
            $created['upvote'] = $created_tot[0]['upvote'];
            foreach($created_tot as $created_res){
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
            echo(json_encode($res));
        }
    }

    require_once(__DIR__ . '/../../db/db_disconnect.php');
?>