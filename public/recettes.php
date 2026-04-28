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
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Unkempt&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="./css/navbar.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="./css/reset.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="./css/roots.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="./css/rcp_form.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="./css/recettes.css?v=<?php echo time(); ?>">
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
    <div id="wrapper_rec">
        <button id="create" class='btn createBtn'>Créer une recette</button>
        <div class="rec">
            <h2>Mes recettes favorites</h2>
            <div id="fav" class='fl-row-recette'>
                
                </div>
            </div>
            <div class="rec">
                <h2>Mes recettes créées</h2>
                <div id="created" class='fl-row-recette'>
                    
                    </div>
                </div>
                
                <div class="screen hidden">
                    <div class="popup_form hidden">
                        <?php
                            echo(createHtmlCreateForm());
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="screen hidden">
        <div class="popup_form hidden">
            <?php
                if(isset($_GET['action']) && isset($_GET['id'])){
                    $action = $_GET['action'];
                    $id = $_GET['id'];
                    if($action == 'modif'){
                        echo(createHtmlModifForm($conn, $id));
                    }
                }
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
                $id_recette = addRecette($conn, $owner, $image, $saison, $price_ind, $health_ind, $titre, $description);
                addRecetteFav($conn, $owner, $id_recette);
                addUpVote($conn, $id_recette);
                addIngredientRecette($conn, $id_recette, $ing, $qte);
                header('Location: ./recettes.php?status=success');
                exit;
            }
        }

    ?>

    <ul id="navbar_ul">
        <li><a href="./account.php">Profil</a></li>
        <li class="selected"><a href="./recettes.php">Mes recettes</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="./semaine.php">Ma semaine</a></li>
        <?php
            if(isset($_SESSION['role'])){
                $role = $_SESSION['role'];
                if($role == 'admin'){
                    echo('<li><a href="./ticketsSee.php" id="ticketsLink">Support</a></li>');
                    }else{
                    echo('<li><a href="./ticketsMake.php" id="ticketsLink">Support</a></li>');
                }
            }
        ?>
    </ul>
</body>
</html>
<script src='./js/fav_recettes.js'></script>
<?php
    require_once(__DIR__ . '/../db/db_disconnect.php');     
?>