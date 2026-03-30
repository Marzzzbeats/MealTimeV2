<?php
/**
 * Gestion des etudiant
 */
$debeug=True ; 

function addRecettes($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description, $upvote, $ingredients){
	$sql="INSERT INTO `recettes` (`owner`, `image`, `saison`, `price_ind`, `health_ind`, `titre`, `description`, `upvote`, `ingredients` ) VALUES ( '$owner', '$image', '$saison', '$price_ind', '$health_ind', '$titre', '$description', '$upvote', '$ingredients')" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ; 
}

function updateRecettes($conn, $id, $nom, $prenom, $pays, $rang){
	$sql="UPDATE `joueur` SET `nom`='$nom',`prenom`='$prenom', `pays`='$pays', `rang`='$rang'  WHERE id = $id" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ; 
}

function deleteRecettes($conn, $id){
	$sql="DELETE FROM `joueur` WHERE id=$id" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ;
}


function selectEtudiant($conn, $id){
	$sql="SELECT * FROM `joueur` WHERE id=$id" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	$tab=rs_to_tab($res) ;
	return $tab[0] ;
}

function listEtudiant($conn){
	$sql="SELECT * FROM `joueur`"; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return rs_to_tab($res) ;
}

?>





