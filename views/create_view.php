<?php

    function createHtmlModifForm(){
        $html = '<form action=recettes.php method=POST>';
        $html .= "<p>Déposez l'image de la recette : <input type='file' id='image' name='image'/></p>";
        $html .= "<p>Entrez le titre de la recette* : <input type='text' id='titre' name='titre' required='required' placeholder='Pâtes à la carbonarra'/></p>";
        $html .= "<p>Entrez une brève description de la recette* : <textarea id='description' name='description' required='required'/></p>";
        $html .= "<p>Entrez l'indice de prix de la recette* <input type='range' id='price_ind' name='price_ind' min='1' max='5' value='1' step='1' /></p>";
    }

?>