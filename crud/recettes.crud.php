<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require_once(__DIR__ . '/../lib/user_utils.php');

	$debeug=false; 

	function addRecette($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description){

		$sql = "INSERT INTO recettes (owner, image, saison, price_ind, health_ind, titre, description) 
				VALUES (?, ?, ?, ?, ?, ?, ?)";

		$stmt = mysqli_prepare($conn, $sql);

		mysqli_stmt_bind_param($stmt,"issiiss",$owner,$image,$saison,$price_ind,$health_ind,$titre,$description);

		if (!mysqli_stmt_execute($stmt)) {
			die("Erreur SQL: " . mysqli_error($conn));
		}

		return mysqli_insert_id($conn);
	}

	function updateRecettes($conn, $id, $saison, $price_ind, $health_ind, $titre, $description){
		$sql="UPDATE `recettes` SET `saison`='$saison', `price_ind`='$price_ind', `health_ind`='$health_ind', `titre`='$titre', `description`='$description' WHERE id = $id"; 
		global $debeug ;
		if($debeug) echo $sql ; 
		$res=mysqli_query($conn, $sql) ; 
		return $res ; 
	}

	function deleteRecette($conn, $id){
		global $debeug;
		$sql = "DELETE FROM recettes WHERE id=$id";
		$sql2 = "DELETE FROM relation_recette_ingredient WHERE id_recette = $id";
		$sql3 = "DELETE FROM favoris WHERE recette_id = $id";
		$res = mysqli_query($conn, $sql);
		$res2 = mysqli_query($conn, $sql2);
		$res3 = mysqli_query($conn, $sql3);

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

	function getRecettesOrderedByPopularity($conn){
		$sql = "SELECT `id`, `owner`, `saison`, `price_ind`, `health_ind`, `titre`, `description`, `upvote` FROM recettes ORDER BY upvote DESC";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab;
	}

	function getRecetteById($conn, $id){
		$sql = "SELECT * FROM recettes WHERE id = $id";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab[0];
	}

	function getRecettesByOwner($conn, $id_owner){
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
			FROM recettes r
			LEFT JOIN relation_recette_ingredient ri 
				ON r.id = ri.id_recette
			LEFT JOIN ingredients i 
				ON ri.id_ingredient = i.id
			WHERE r.owner = ?
			ORDER BY r.id
		";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "i", $id_owner);
		mysqli_stmt_execute($stmt);

		$res = mysqli_stmt_get_result($stmt);
		return rsToAssoc($res);
	}

	function getIdDerniereRecette($conn, $owner){
		$sql = "SELECT id FROM recettes WHERE `owner`=$owner ORDER BY id DESC LIMIT 1";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab[0];
	}

	function getImageRecette($conn, $id){
		$sql = "SELECT `image` FROM recettes WHERE id=$id";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab; 
	}

	function getUpVotes($conn, $recette_id){
		$sql = "SELECT upvote FROM recettes WHERE id = $recette_id";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab[0];
	}

	function addUpVote($conn, $recette_id){
		$uv = getUpVotes($conn, $recette_id);
		$nb_uv = $uv['upvote'];
		$uvv = $nb_uv+1;
		$sql = "UPDATE recettes SET upvote=$uvv WHERE id=$recette_id";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function delUpVote($conn, $recette_id){
		$uv = getUpVotes($conn, $recette_id);
		$nb_uv = $uv['upvote'];
		$uvv = $nb_uv-1;
		$sql = "UPDATE recettes SET upvote=$uvv WHERE id=$recette_id";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function getIdRecettesFav($conn, $user_id){
		$sql = "SELECT recette_id FROM favoris WHERE user_id = $user_id";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab;
	}

?>



