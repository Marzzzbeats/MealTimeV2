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
    <link rel="stylesheet" href="./css/semaine.css">
    <title>MA SEMAINE</title>
</head>
<body>

    <?php session_start(); ?>

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

    <div id="message"></div>
    <div id="tableau"></div>

    <button id="bouton">Plus d'options</button>
    <div id="formulaire">
        <h1>Formulaire</h1>
        <form method="post" action="">
            <p>Indice de prix :</p>
            <select name="prix">
                <option value="5">5 (cher)</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1 (abordable)</option>
            </select>

            <p>Indice de santé :</p>
            <select name="sante">
                <option value="5">5 (sain)</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1 (mauvais)</option>
            </select>

            <p>Saison :</p>
            <select name="saison">
                <option value="printemps">printemps</option>
                <option value="ete">été</option>
                <option value="automne">automne</option>
                <option value="hiver">hiver</option>
                <option value="tous">toutes saisons</option>
            </select>

            <br><br>
            <input type="submit" value="Valider">
        </form>
    </div>

    <script src="./js/semaine.js"></script>

</body>
</html>