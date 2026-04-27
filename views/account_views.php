<?php
    require_once(__DIR__ . '/../crud/user.crud.php');

    function createHtmlModifNameForm($conn){
        $html = '<form action=account.php method=POST class="rcp_form" enctype="multipart/form-data">';
        $html .= '<h4>Modifiez votre nom </h4>';
        $id = $_SESSION['id'];
        $user = getUserById($conn, $id);
        $nom = $user[0]['nom'];
        $prenom = $user[0]['prenom'];
        $html .= "<p>Entrez votre nouveau nom *: <input type='text' id='nom' name='nom' value='$nom'/></p>";
        $html .= "<p>Entrez votre nouveau prénom* : <input type='text' id='prenom' name='prenom' required='required' value='$prenom'/></p>";
        $html .= "<p>* Obligatoire </p>";
        $html .= "<input type='hidden' name='action' id='action' value='modif_name'/>";
        $html .= "<button type='submit' class='btn createBtn'>Modifier le nom</button>";
        $html .= "</form>";
        return $html;
    }

    function createHtmlModifEmailForm($conn){
        $html = '<form action=account.php method=POST class="rcp_form" enctype="multipart/form-data">';
        $html .= '<h4>Modifiez votre email</h4>';
        $id = $_SESSION['id'];
        $user = getUserById($conn, $id);
        $email = $user[0]['email'];
        $html .= "<p>Entrez votre nouvel email *: <input type='email' id='email' name='email' value='$email'/></p>";
        $html .= "<p>* Obligatoire </p>";
        $html .= "<input type='hidden' name='action' id='action' value='modif_email' />";
        $html .= "<button type='submit' class='btn createBtn'>Modifier l'email</button>";
        $html .= "</form>";
        return $html;
    }

    function createHtmlModifPasswordForm($conn){
        $html = '<form action=account.php method=POST class="rcp_form" enctype="multipart/form-data">';
        $html .= '<h4>Modifiez votre mot de passe </h4>';
        $html .= "<p>Entrez votre ancien mot de passe*: <input type='password' id='old_pass' name='old_pass' required='required'/></p>";
        $html .= "<p>Entrez votre nouveau mot de passe* : <input type='password' id='new_pass' name='new_pass' required='required' /></p>";
        $html .= "<p>* Obligatoire </p>";
        $html .= "<input type='hidden' name='action' id='action' value='modif_password' />";
        $html .= "<button type='submit' class='btn createBtn'>Modifier le mot de passe</button>";
        $html .= "</form>";
        return $html;
    }

    function createHtmlModifPpForm($conn){
        $html = '<form action=account.php method=POST class="rcp_form" enctype="multipart/form-data">';
        $html .= '<h4>Modifiez votre photo de profil </h4>';
        $html .= "<p>Déposez votre nouvelle photo (format JPG ou JPEG) *: <input type='file' id='pp' name='pp' accept='image/*'/></p>";
        $html .= "<p>* Obligatoire </p>";
        $html .= "<input type='hidden' name='action' id='action' value='modif_pp' />";
        $html .= "<button type='submit' class='btn createBtn'>Modifier la photo</button>";
        $html .= "</form>";
        return $html;
    }

?>