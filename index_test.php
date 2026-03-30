<?php
include("./db/db_connect.php") ; 
include("./crud/recettes.crud.php") ; 
include("./views/recettes.views.php") ; 

?>
<html>
<head>
<style>
	table { border-collapse:collapse;}
	table tr td { border:1px solid black ; }
	td { padding:4px; }
	tr:nth-child(even) {background: #CCC}
	tr:nth-child(odd) {background: #FFF}	
</style>
</head>
<body>
<header>


</header>
<?php

/**
 * Controlleur : Traite les actions provenant des requetes POST et GET
 */

if(isset($_GET["action"]) && isset($_GET["id"])){

	$action=$_GET["action"];
	$id=$_GET["id"];

	if($action=="update"){
		
		/* Formulaire de maj d'un etudiant */
		$etudiant=select_etudiant($conn, $id) ;
		$html=html_form_maj($etudiant) ;
		echo($html) ;				
		
	} elseif($action=="create"){
		
		/* Formulaire creation d'un etudiant */
		$html=html_form_create() ;
		echo($html) ; 
	
	} elseif($action=="delete"){

		/* Supression d'un etudiant */	
		delete_etudiant($conn, $id) ;
	}
}


if(isset($_POST["action"]) && isset($_POST["id"])){
	$action=$_POST["action"];
	$id=$_POST["id"];

	$nom=$_POST["nom"] ; 
	$prenom=$_POST["prenom"] ;
	$pays=$_POST["pays"] ;
	$rang=$_POST["rang"] ;
			
	if($action=="update"){
		/* traitement du formulaire d'ajout */
		update_etudiant($conn, $id, $nom, $prenom, $pays, $rang); 	

	} elseif($action=="create"){
		/* traitement du formulaire de maj */
		insert_etudiant($conn, $nom, $prenom, $pays, $rang); 
	}
}

?>

<!-- tableau de gestion des etudiants -->
<?php
$etudiants=list_etudiant($conn) ;
$html=html_table_etudiant($etudiants);
echo($html) ;


include "db_disconnect.php";
?>

<!-- lien d'ajout d'un etudiant -->
<a href="../index.php">RETOUR</a>

</body>
</html>
