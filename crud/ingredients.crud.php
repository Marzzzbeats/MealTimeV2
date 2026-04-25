<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/./recettes.crud.php');
    require_once(__DIR__ . '/../lib/user_utils.php');

    function getIngredients($conn){
        $sql = "SELECT * FROM ingredients";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }

    function getIngredientByNom($conn, $nom){
        $sql = "SELECT * FROM ingredients WHERE nom='$nom'";
        $res = mysqli_query($conn, $sql);
        $tab = rsToAssoc($res);
        return $tab;
    }

    function addIngredientRecette($conn, $id_recette, $str_ing, $str_qte){
        $list_ing = strToList($str_ing);
        $list_qte = strToList($str_qte);
        for($i=0; $i<count($list_ing); $i++){
            $ing = $list_ing[$i];
            $qte = $list_qte[$i];
            $res = getIngredientByNom($conn, $ing);
            if($res == []){
                $sql1 = "INSERT INTO ingredients (`nom`) VALUES ('$ing')";
                $res2 = mysqli_query($conn, $sql1);
                $ind_ing = mysqli_insert_id($conn); //Dernier id Auto Incrémenté
            }else{
                $ind_ing = $res[0]['id'];
            }
            $sql2 = "INSERT INTO relation_recette_ingredient (`id_recette`, `id_ingredient`, `quantite`) VALUES ($id_recette, $ind_ing, '$qte')";
            $res3 = mysqli_query($conn, $sql2);
        }
    }
?>