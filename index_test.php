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

		update_etudiant($conn, $id, $nom, $prenom, $pays, $rang); 	

	} elseif($action=="create"){
		/* traitement du formulaire de maj */
		insert_etudiant($conn, $nom, $prenom, $pays, $rang); 
	}
}

?>

<h2>Ajouter une recette (test)</h2>
<form method="POST">

    Owner: <input type="number" name="owner" value="1"><br><br>
    Image: <input type="text" name="image"><br><br>
    Saison: <input type="text" name="saison" value="printemps"><br><br>
    Price: <input type="number" name="price_ind" value="4"><br><br>
    Health: <input type="number" name="health_ind" value="5"><br><br>
    Titre: <input type="text" name="titre"><br><br>
    Description: <input type="text" name="description"><br><br>
    Upvote: <input type="number" name="upvote" value="5"><br><br>
    Ingredients: <input type="text" name="ingredients" value="salade"><br><br>
    Quantité: <input type="text" name="quantite" value="4"><br><br>

    <input type="submit" name="add_recette" value="Ajouter">

</form>


<?php
$etudiants=list_etudiant($conn) ;
$html=html_table_etudiant($etudiants);
echo($html) ;


include "db_disconnect.php";
?>


</body>
</html>
