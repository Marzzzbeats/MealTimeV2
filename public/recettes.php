<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    session_start();
    require_once(__DIR__ . '/../db/db_connect.php');
    require_once(__DIR__ . '/../crud/recettes.crud.php');
    require_once(__DIR__ . '/../views/create_view.php');
    require_once(__DIR__ . '/../crud/favoris.crud.php');
    require_once(__DIR__ . '/../crud/ingredients.crud.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/roots.css">
    <title>Mes recettes</title>
</head>
<body>
    <?php
        if(isset($_GET['status'])){
            $status = $_GET['status'];
            if($status == 'success'){
                echo('<div class="alert">Recette bien enregistrée dans la base</div>');
            }
        }
    ?>
    <div>
        <h2>Mes recettes favorites</h2>
        <div id="fav" class='fl-row-recette'>

        </div>
    </div>
    <div>
        <h2>Recettes créées</h2>
        <div id="created" class='fl-row-recette'>

        </div>
    </div>

    <button id="create" class='btn'>Créer une recette</button>

    <div class="screen hidden">
        <div class="popup_form hidden">
            <?php
                echo(createHtmlCreateForm());
            ?>
        </div>
    </div>

    <?php

        if(isset($_POST['action'])){
            $action=$_POST['action'];
            if($action == "create"){
                $owner = $_SESSION['id'];
                if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
                    $tmp = $_FILES['image']['tmp_name']; //Nom temporaire du fichier coté serveur
                    $data = file_get_contents($tmp);
                }
                if(isset($data)){
                    $image = $data;
                }else{
                    $image = ""; 
                }
                $saison = $_POST['saison'];
                $price_ind = $_POST['price_ind'];
                $health_ind = $_POST['health_ind'];
                $titre = $_POST['titre'];
                $description = $_POST['description'];
                $ing = $_POST['ingredients'];
                $qte = $_POST['quantite'];
                addRecette($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description);
                $id_recette = getIdDerniereRecette($conn, $owner);
                addRecetteFav($conn, $owner, $id_recette['id']);
                addIngredientRecette($conn, $id_recette['id'], $ing, $qte);
                header('Location: ./recettes.php?status=success');
            }
        }

    ?>

    <ul>
        <li><a href="./profil.php">Profil</a></li>
        <li class="selected"><a href="./favoris.php">Favoris</a></li>
        <li><a href="./index.php">Accueil</a></li>
        <li><a href="./semaine.php">Semaine</a></li>
        <li><a href="./tickets.php">Tickets</a></li>
    </ul>
</body>
</html>
<script src='./js/fav_recettes.js'></script>
<link rel="stylesheet" href="./css/recettes.css">
<?php
    require_once(__DIR__ . '/../db/db_disconnect.php');     
?>