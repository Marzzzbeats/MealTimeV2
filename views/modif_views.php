<?php
    require_once(__DIR__ . '/../crud/ingredients.crud.php');
    require_once(__DIR__ . '/../crud/recettes.crud.php');

    function createHtmlModifForm($conn, $id){
        $recette = getRecetteById($conn, $id);
        $owner = $recette['owner'];
        $titre = $recette['titre'];
        $desc = $recette['description'];
        $price_ind = $recette['price_ind'];
        $health_ind = $recette['health_ind'];
        $saison = $recette['saison'];
        $ingredients = getIngredientsRecette($conn, $id);
        $quantite = getQuantiteRecette($conn, $id);
        $html = '<form action=recettes.php method=POST class="rcp_form">';
        $html .= "<p>Entrez le titre de la recette* : <input type='text' id='titre' name='titre' required='required' placeholder='Pâtes à la carbonarra' value='$titre'/></p>";
        $html .= "<p>Entrez une brève description de la recette* : <textarea id='description' name='description' required='required'>$desc</textarea></p>";
        $html .= "<p>Entrez les ingrédients* : <input type='text' id='ingredients' name='ingredients' required='required' placeholder='Pâtes fraîches, lardons, ...' value='$ingredients' /></p>";
        $html .= "<p>Entrez les quantités (dans l'ordre des ingrédients)* : <input type='text' id='quantite' name='quantite' required='required' placeholder='300g, 20cl, 100g, ...' value='$quantite' /></p>";
        $html .= "<p>Entrez l'indice de prix de la recette* <input type='range' id='price_ind' name='price_ind' min='1' max='5' step='1' value='$price_ind' /></p>";
        $html .= "<p>Entrez l'indice de santé de la recette* <input type='range' id='health_ind' name='health_ind' min='1' max='5' step='1' value='$health_ind'/></p>";
        $html .= "<p>Saison de consommation suggerée : <select name='saison' id='saison' required='required' selected='$saison' >";
        $html .= "<option value='all'>Toutes saisons</option>";
        $html .= "<option value='hiver'>Hiver</option>";
        $html .= "<option value='printemps'>Printemps</option>";
        $html .= "<option value='ete'>Ete</option>";
        $html .= "<option value='automne'>Automne</option>";
        $html .= "</select></p>";
        $html .= "<p>* Obligatoire </p>";
        $html .= "<input type='hidden' name='action' id='action' value='modif' />";
        $html .= "<input type='hidden' name='owner' id='owner' value='$owner'>";
        $html .= "<button type='submit' class='btn createBtn'>Modifier</button>";
        $html .= "<input type='hidden' name='id' value='$id'>";
        $html .= "</form>";
        return $html;
    }


?>