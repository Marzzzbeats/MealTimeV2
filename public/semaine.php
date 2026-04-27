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
    <title>MA SEMAINE</title>
    <link rel="stylesheet" href="./css/semaine.css">

</head>
<body>
    <script src="./js/semaine.js"></script>
    <div id='formulaire'>
        <h1>Formulaire</h1>
        <form method="post" action="">
    
            <p>Indice de prix :</p>
            <select name="prix">
                <option value="5" <?= (@$_POST["prix"] == 5) ? "selected" : "" ?>>5 (cher)</option>
                <option value="4" <?= (@$_POST["prix"] == 4) ? "selected" : "" ?>>4</option>
                <option value="3" <?= (@$_POST["prix"] == 3) ? "selected" : "" ?>>3</option>
                <option value="2" <?= (@$_POST["prix"] == 2) ? "selected" : "" ?>>2</option>
                <option value="1" <?= (@$_POST["prix"] == 1) ? "selected" : "" ?>>1 (abordable)</option>
            </select>
    
            <p>Indice de santé :</p>
            <select name="sante">
                <option value="5" <?= (@$_POST["sante"] == 5) ? "selected" : "" ?>>5 (sain)</option>
                <option value="4" <?= (@$_POST["sante"] == 4) ? "selected" : "" ?>>4</option>
                <option value="3" <?= (@$_POST["sante"] == 3) ? "selected" : "" ?>>3</option>
                <option value="2" <?= (@$_POST["sante"] == 2) ? "selected" : "" ?>>2</option>
                <option value="1" <?= (@$_POST["sante"] == 1) ? "selected" : "" ?>>1 (mauvais)</option>
            </select>
    
            <p>Saison :</p>
            <select name="saison">
                <option value="printemps" <?= (@$_POST["saison"] == 'printemps') ? "selected" : "" ?>>printemps</option>
                <option value="ete" <?= (@$_POST["saison"] == 'ete') ? "selected" : "" ?>>été</option>
                <option value="automne" <?= (@$_POST["saison"] == 'automne') ? "selected" : "" ?>>automne</option>
                <option value="hiver" <?= (@$_POST["saison"] == 'hiver') ? "selected" : "" ?>>hiver</option>
                <option value="all" <?= (@$_POST["saison"] == 'all') ? "selected" : "" ?>>toutes saisons</option>
            </select>
    
            <br><br>
            <input type="submit" value="Valider">
        </form>
    </div>
    <?php
        require_once(__DIR__ . '/../db/db_connect.php');
        require_once(__DIR__ . '/../crud/favoris.crud.php');
        require_once(__DIR__ . '/../crud/semaine.crud.php');
        require_once(__DIR__ . '/../crud/recettes.crud.php');
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $user_id = $_SESSION['id']; 
    ?>

    <ul id="navbar_ul">
        <li><a href="./account.php">Profil</a></li>
        <li><a href="./recettes.php">Mes recettes</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <li class="selected"><a href="./semaine.php">Ma semaine</a></li>
        <?php
            if(isset($_SESSION['role'])){
                $role = $_SESSION['role'];
                if($role == 'admin'){
                    echo('<li><a href="./ticketsSee.php" id="ticketsLink">Tickets</a></li>');
                }else{
                    echo('<li><a href="./ticketsMake.php" id="ticketsLink">Tickets</a></li>');
                }
            }
        ?>
    </ul>

    <!-- <div id='tableau'></div> -->

    <button id="bouton">Plus d'options</button>
</body>
</html>