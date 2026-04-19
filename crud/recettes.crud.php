<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require_once(__DIR__ . '/../lib/user_utils.php');

	$debeug=false; 

	function addRecette($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description){
		$sql="INSERT INTO recettes (`owner`, `image`, `saison`, `price_ind`, `health_ind`, `titre`, `description`) VALUES ( $owner, '$image', '$saison', $price_ind, $health_ind, '$titre', '$description')" ; 
		global $debeug;
		if($debeug){
			echo($sql); 
		}
		$res=mysqli_query($conn, $sql);
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
		global $debeug;
		$sql = "DELETE FROM recettes WHERE id=$id";
		$res = mysqli_query($conn, $sql);
		if(!$res && $debeug){
			echo("Erreur de suppression");
		}
		return $res;
	}


	function getRecettes($conn){
		$sql = "SELECT * FROM recettes JOIN relation_recette_ingredient ON recettes.id = relation_recette_ingredient.id_recette JOIN ingredients ON relation_recette_ingredient.id_ingredient = ingredients.id";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab;
	}

	function getRecetteById($conn, $id){
		$sql = "SELECT * FROM recettes JOIN relation_recette_ingredient ON recettes.id = relation_recette_ingredient.id_recette JOIN ingredient ON relation_recette_ingredient.id_ingredient = ingredients.id WHERE recettes.id = $id";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab[0];
	}

	function getRecettesByOwner($conn, $id_owner){
		$sql = "SELECT * FROM recettes JOIN relation_recette_ingredient ON recettes.id = relation_recette_ingredient.id_recette JOIN ingredients ON relation_recette_ingredient.id_ingredient = ingredients.id WHERE recettes.owner = $id_owner";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab;
	}

	function getIdDerniereRecette($conn, $owner){
		$sql = "SELECT id FROM recettes WHERE `owner`=$owner ORDER BY id DESC LIMIT 1";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab[0];
	}

	function getImageRecette($conn, $id){
		$sql = "SELECT image FROM recettes WHERE id=$id";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab[0]; 
	}

/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab($rs){
	$tab=[] ; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row ;	
	}
	return $tab;
}





?>



