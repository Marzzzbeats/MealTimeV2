<?php
/**
 * Gestion des etudiant
 */
$debeug=True ; 

function addRecettes($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description, $upvote, $ingredients,  $quantite){
	$sql="INSERT INTO recettes (`owner`, `image`, `saison`, `price_ind`, `health_ind`, `titre`, `description`, `upvote`, `ingredients`, `quantite` ) VALUES ( $owner, '$image', '$saison', $price_ind, $health_ind, '$titre', '$description', $upvote, '$ingredients', '$quantite')" ; 
	global $debeug;
	if($debeug){
        echo($sql); 
    }
	$res=mysqli_query($conn, $sql);
    echo($res);
	return $res ; 
}


function updateRecettes($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description, $upvote, $ingredients,  $quantite){
    $id = "SELECT id FROM `recettes` WHERE titre = '$titre'";
    $sql="UPDATE `recettes` SET `owner`='$owner',`image`='$image', `saison`='$saison', `price_ind`='$price_ind', `health_ind`='$health_ind', `titre`='$titre', `description`='$description', `ingredients`='$ingredients', `quantite`='$quantite'  WHERE id = $id"; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ; 
}

function delete_etudiant($conn, $id){
	$sql="DELETE FROM `joueur` WHERE id=$id" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ;
}


function select_etudiant($conn, $id){
	$sql="SELECT * FROM `joueur` WHERE id=$id" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	$tab=rs_to_tab($res) ;
	return $tab[0] ;
}

function list_etudiant($conn){
	$sql="SELECT * FROM `joueur`"; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return rs_to_tab($res) ;
}

?>






