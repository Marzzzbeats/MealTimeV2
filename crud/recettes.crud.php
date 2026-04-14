<?php
/**
 * Gestion des etudiant
 */
$debeug=True ; 

function addRecettes($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description, $upvote, $ingredients, $quantite){
 
    $sql="INSERT INTO recettes (`owner`, `image`, `saison`, `price_ind`, `health_ind`, `titre`, `description`, `upvote`, `ingredients`, `quantite`)
    VALUES ($owner, '$image', '$saison', $price_ind, $health_ind, '$titre', '$description', $upvote, '$ingredients', '$quantite')" ; 

    global $debeug;
    if($debeug) echo($sql); 

    $res=mysqli_query($conn, $sql);
    return $res ; 
}


function update_etudiant($conn, $id, $blanc, $noir, $rb, $rn, $annee){
	$sql="UPDATE `partie` SET `blanc`='$blanc',`noir`='$noir', `rb`='$rb', `rn`='$rn', `annee`='$annee'  WHERE id = $id" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ; 
}

function delete_etudiant($conn, $id){
	$sql="DELETE FROM `partie` WHERE id=$id" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ;
}


function select_etudiant($conn, $id){
	$sql="SELECT * FROM `partie` WHERE id=$id" ; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	$tab=rs_to_tab($res) ;
	return $tab[0] ;
}

function list_etudiant($conn){
	$sql="SELECT * FROM `partie`"; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return rs_to_tab($res) ;
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



