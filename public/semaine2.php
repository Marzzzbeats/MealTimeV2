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
    <?php
        require_once(__DIR__ . '/../db/db_connect.php');
        require_once(__DIR__ . '/../crud/favoris.crud.php');
        require_once(__DIR__ . '/../crud/semaine.crud.php');
        require_once(__DIR__ . '/../crud/recettes.crud.php');
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $user_id = $_SESSION['id']; 


        function recettes_random($data){ 
            for ($i = count($data) - 1; $i > 0; $i--) {
                $j = (random_int(0, $i));
                [$data[$i], $data[$j]] = [$data[$j], $data[$i]];
            }
            return $data;
        }
        
        function get_semaine_titre($conn, $semaine, $recettes){
            $semaine = $semaine[0] ?? null;
            $tableau_nom_recettes = [];
            for ($i = 1; $i <= 14; $i++) {
                $id = $semaine["id_plat_$i"];
                $recette = getRecetteById($conn, $id)['titre'];
                $tableau_nom_recettes[] = $recette;
            }
            return $tableau_nom_recettes;
        }

        function get_semaine_id($conn, $semaine, $recettes){
            $semaine = $semaine[0] ?? null;
            $tableau_id_recettes = [];
            for ($i = 1; $i <= 14; $i++) {
                $id = $semaine["id_plat_$i"];
                $tableau_id_recettes[] = $id;
            }
            return $tableau_id_recettes;
        }

        function trouve_dans_favoris($id_de_la_recette, $recettes){
            $trouve = FALSE;
            $i = 0; 
            while ($i < count($recettes) && (!$trouve)) {
                if ($id_de_la_recette == $recettes[$i]['recette_id']){
                    $trouve = TRUE;
                }
                $i++;
            }
            return $trouve;
        }

        function compare_semaine_favoris($conn, $semaine, $recettes){
            $res = TRUE;
            $semaine = get_semaine_id($conn, $semaine, $recettes);
            for ($i = 0; $i < 14; $i++) {
                $id_de_la_recette = $semaine[$i];
                if (!trouve_dans_favoris($id_de_la_recette, $recettes)){
                    $res = FALSE;
                }
            }
            return $res;
        }
        


        $semaine = getSemaineByUser($conn,$user_id);
        if ($semaine){
            $recettes = getRecettesFavoris($conn, $user_id);
            if (count($recettes) < 14){
                deleteSemaine($conn,$user_id);
                echo("<h2>Vous n'avez pas assez de recettes en favoris !</h2>");
                $nb_recette_maquant = 14 - count($recettes);
                if ($nb_recette_maquant === 1){
                    echo("<br><h2>Il vous manque 1 recette favorite pour programmer une semaine complète.</h2>");
                }
                else {
                    echo("<br><h2>Il vous manque $nb_recette_maquant recettes favorites pour programmer une semaine complète.</h2>");
                }
            }
            else if(!compare_semaine_favoris($conn, $semaine, $recettes)){
                deleteSemaine($conn,$user_id);
                echo("<h2>Vous avez retiré de vos favoris une recette présente dans votre semaine.</h2>");
                echo("<h2>Une nouvelle semaine va être chargée.</h2>");
                }
            else {
                $tableau_nom_recettes = get_semaine_titre($conn, $semaine, $recettes);
                $tableau_id_recettes = get_semaine_id($conn, $semaine, $recettes);
            }
        }
        else {
            $recettes = getRecettesFavoris($conn, $user_id);
            if (count($recettes) < 14){
                echo("<h2>Vous n'avez pas assez de recettes en favoris !</h2>");
                $nb_recette_maquant = 14 - count($recettes);
                if ($nb_recette_maquant === 1){
                    echo("<br><h2>Il vous manque 1 recette favorite pour programmer une semaine complète.</h2>");
                    }
                    else {
                    echo("<br><h2>Il vous manque $nb_recette_maquant recettes favorites pour programmer une semaine complète.</h2>");
                }
            }
            else {
                $recettes = getRecettesFavoris($conn, $user_id);
                $recettes_shuffle = recettes_random($recettes);
                $p1 = $recettes_shuffle[0]['recette_id'];
                $p2 = $recettes_shuffle[1]['recette_id'];
                $p3 = $recettes_shuffle[2]['recette_id'];
                $p4 = $recettes_shuffle[3]['recette_id'];
                $p5 = $recettes_shuffle[4]['recette_id'];
                $p6 = $recettes_shuffle[5]['recette_id'];
                $p7 = $recettes_shuffle[6]['recette_id'];
                $p8 = $recettes_shuffle[7]['recette_id'];
                $p9 = $recettes_shuffle[8]['recette_id'];
                $p10 = $recettes_shuffle[9]['recette_id'];
                $p11 = $recettes_shuffle[10]['recette_id'];
                $p12 = $recettes_shuffle[11]['recette_id'];
                $p13 = $recettes_shuffle[12]['recette_id'];
                $p14 = $recettes_shuffle[13]['recette_id'];

                addSemaine($conn,$user_id,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14);
                $semaine = getSemaineByUser($conn,$user_id);
                $tableau_nom_recettes = get_semaine_titre($conn, $semaine, $recettes);
                $tableau_id_recettes = get_semaine_id($conn, $semaine, $recettes);
            }
        }
    ?>


    <script src="./js/semaine.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", async() => {
            let tableau_nom_recettes = <?php echo json_encode($tableau_nom_recettes); ?>;
            let tableau_id_recettes = <?php echo json_encode($tableau_id_recettes); ?>;
            console.log(tableau_id_recettes);
            const user = await init();
            await creer_tableau_semaine(tableau_nom_recettes, tableau_id_recettes);
        });
    </script>

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

    <div id='message'></div>
    <div id='tableau'></div>

    <button id="bouton">Plus d'options</button>
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
                <option value="tous" <?= (@$_POST["saison"] == 'tous') ? "selected" : "" ?>>toutes saisons</option>
            </select>

            <br><br>
            <input type="submit" value="Valider">
        </form>
    </div>
</body>
</html>