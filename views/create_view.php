<?php

    function createHtmlCreateForm(){
        $html = '<form action=recettes.php method=POST class="rcp_form" enctype="multipart/form-data">';
        $html .= '<div class="close_div"><button class="btn delBtn" id="close">X</button></div>';
        $html .= "<p>Déposez l'image de la recette (format JPEG attendu): <input type='file' id='image' name='image' accept='image/*'/></p>";
        $html .= "<p>Entrez le titre de la recette* : <input type='text' id='titre' name='titre' required='required' placeholder='Pâtes à la carbonarra'/></p>";
        $html .= "<p>Entrez une brève description de la recette* : <textarea id='description' name='description' required='required'></textarea></p>";
        $html .= "<p>Entrez les ingrédients* : <input type='text' id='ingredients' name='ingredients' required='required' placeholder='Pâtes fraîches, lardons, ...'/></p>";
        $html .= "<p>Entrez les quantités (dans l'ordre des ingrédients)* : <input type='text' id='quantite' name='quantite' required='required' placeholder='300g, 20cl, 100g, ...'/></p>";
        $html .= "<p>Entrez l'indice de prix de la recette* <input type='range' id='price_ind' name='price_ind' min='1' max='5' value='1' step='1' /></p>";
        $html .= "<p>Entrez l'indice de santé de la recette* <input type='range' id='health_ind' name='health_ind' min='1' max='5' value='1' step='1' /></p>";
        $html .= "<p>Saison de consommation suggerée : <select name='saison' id='saison' required='required'>";
        $html .= "<option value='all'>Toutes saisons</option>";
        $html .= "<option value='hiver'>Hiver</option>";
        $html .= "<option value='printemps'>Printemps</option>";
        $html .= "<option value='ete'>Ete</option>";
        $html .= "<option value='automne'>Automne</option>";
        $html .= "</select></p>";
        $html .= "<p>* Obligatoire </p>";
        $html .= "<input type='hidden' name='action' id='action' value='create' />";
        $html .= "<button type='submit' class='btn createBtn' id='submit_btn'>Créer la recette</button>";
        $html .= "</form>";
        return $html;
    }

?>