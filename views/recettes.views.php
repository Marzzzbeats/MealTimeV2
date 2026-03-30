<?php
/* 
 * VUE: Composants de l'interface graphique.
 */



/** 
 * Tableau des etudiants  
 */
function html_table_etudiant($etudiants){
	$html="<table>\n" ; 

	//creation des lignes 
	foreach($etudiants as $etudiant){
		$html.=html_tr_etudiant($etudiant) ; 	
	}

	$html.="</table>\n" ; 
	return $html ; 
}

/**
 * Ligne du tableau: etudiant | prenom | no | edition | suppression
 */
function html_tr_etudiant($etudiant){
	$html="\t<tr>\n" ; 
	
	$id 	= $etudiant["id"] ; 
	$nom 	= $etudiant["nom"] ; 
	$prenom = $etudiant["prenom"] ; 
	$pays	= $etudiant["pays"] ; 
	$rang	= $etudiant["rang"] ; 

	$html.="\t\t<td>$nom</td>\n" ;
	$html.="\t\t<td>$prenom</td>\n" ;
	$html.="\t\t<td>$pays</td>\n" ;
	$html.="\t\t<td>$rang</td>\n" ;

	$a_update=html_a_update_etudiant($id) ; 
	$html.="\t\t<td>$a_update</td>\n" ;
	
	$a_delete=html_a_delete_etudiant($id) ; 
	$html.="\t\t<td>$a_delete</td>\n" ;
	
	$html.="\t</tr>\n" ; 
	return $html ;
}

/**
 * Lien de suppression
 */
function html_a_delete_etudiant($id){
	$href="admin_etudiant.php?action=delete&table=etudiant&id=$id" ; 
	$html="<a href='$href' ><img src='delete.png' width='30px'></a>" ;
       	return $html ; 	
}

/**
 * Lien de maj
 */
function html_a_update_etudiant($id){
	$href="admin_etudiant.php?action=update&table=etudiant&id=$id" ; 
	$html="<a href='$href' ><img src='pencil.png' width='30px'></a>" ;
       	return $html ; 	
}

/*
 * Formulaire de maj d'un etudiant
 */
function html_form_maj($etudiant){
	$id 	= $etudiant["id"] ; 
	$nom 	= $etudiant["nom"] ; 
	$prenom = $etudiant["prenom"] ; 
	$pays	= $etudiant["pays"] ; 
	$rang	= $etudiant["rang"] ; 
	
	$html="<form action='admin_etudiant.php' method='POST'>\n" ; 
	$html.="<label for='nom'>Nom</label>\n" ;
	$html.="\t<input type='text' name='nom' value='$nom'>\n" ; 
	$html.="<label for='prenom'>Prénom</label>\n" ;
	$html.="\t<input type='text' name='prenom' value='$prenom'>\n" ; 
	$html.="<label for='pays'>Pays</label>\n" ;
	$html.="\t<input type='text' name='pays' value='$pays'>\n" ; 
	$html.="<label for='rang'>Rang</label>\n" ;
	$html.="\t<input type='text' name='rang' value='$rang'>\n" ; 
	$html.="\t<input type='hidden' name='id' value='$id'>\n" ; 
	$html.="\t<input type='hidden' name='action' value='update'>\n" ; 
	$html.="\t<input type='submit'>\n" ; 
	$html.="</form>\n";

	return $html ; 
}

/**
 * Formulaire de creation d'un etudiant
 */
function html_form_create(){
	
	$html="<form action='admin_etudiant.php' method='POST'>\n" ; 
	$html.="<label for='nom'>Nom</label>\n" ;
	$html.="\t<input type='text' name='nom' >\n" ; 
	$html.="<label for='prenom'>Prénom</label>\n" ;
	$html.="\t<input type='text' name='prenom' >\n" ; 
	$html.="<label for='pays'>Pays</label>\n" ;
	$html.="\t<input type='text' name='pays' >\n" ; 
	$html.="<label for='rang'>Rang</label>\n" ;
	$html.="\t<input type='text' name='rang' >\n" ; 
	$html.="\t<input type='hidden' name='action' value='create'>\n" ; 
	$html.="\t<input type='hidden' name='id'>\n" ; 
	$html.="\t<input type='submit'>\n" ; 
	$html.="</form>\n";

	return $html ; 
}
?>
