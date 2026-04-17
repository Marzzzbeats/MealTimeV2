<?php
require_once(__DIR__ . '/../lib/user_utils.php');
$debeug=True ; 

function addRecettes($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description){
	$sql="INSERT INTO recettes (`owner`, `image`, `saison`, `price_ind`, `health_ind`, `titre`, `description`) VALUES ( $owner, '$image', '$saison', $price_ind, $health_ind, '$titre', '$description')" ; 
	global $debeug;
	if($debeug){
        echo($sql); 
    }
	$res=mysqli_query($conn, $sql);
    echo($res);
	return $res ; 
}


function updateRecettes($conn, $id, $image, $saison, $price_ind, $health_ind, $titre, $description){
    $sql="UPDATE `recettes` SET `image`='$image', `saison`='$saison', `price_ind`='$price_ind', `health_ind`='$health_ind', `titre`='$titre', `description`='$description' WHERE id = $id"; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ; 
}

function deleteRecette($conn, $id){
	global $debeug
	$sql = "DELETE FROM recettes WHERE id=$id";
	$res = mysqli_query($conn, $sql);
	if(!$res && $debeug){
		echo("Erreur de suppression");
	}
	return $res;
}


function getRecettes($conn){
	$sql = "SELECT * FROM recettes JOIN relation_recette_ingredient ON recettes.id = relation_recette_ingredient.id_recettes JOIN ingredients ON relation_recette_ingredient.id_ingredient = ingredients.id";
	$res = mysqli_query($conn, $sql);
	$tab = rsToAssoc($res);
	return $tab;
}

function getRecetteById($conn, $id){
	$sql = "SELECT * FROM recettes JOIN relation_recette_ingredient ON recettes.id = relation_recette_ingredient.id_recettes JOIN ingredients ON relation_recette_ingredient.id_ingredient = ingredients.id WHERE recettes.id = $id";
	$res = mysqli_query($conn, $sql);
	$tab = rsToAssoc($res);
	return $tab[0];
}

function getRecetteByOwner($conn, $id_owner){
	$sql = "SELECT * FROM recettes JOIN relation_recette_ingredient ON recettes.id = relation_recette_ingredient.id_recettes JOIN ingredients ON relation_recette_ingredient.id_ingredient = ingredients.id WHERE recettes.owner = $id_owner";
	$res = mysqli_query($conn, $sql);
	$tab = rsToAssoc($res);
	return $tab;
}

?>






