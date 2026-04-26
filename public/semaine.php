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
        // $user_id = 6;
        // echo($user_id);

        function recettes_random($data){ // me permet de mélanger les recettes entre elles.
            for ($i = count($data) - 1; $i > 0; $i--) {
                $j = (random_int(0, $i));
                [$data[$i], $data[$j]] = [$data[$j], $data[$i]];
            }
            return $data;
        }
        
        function get_semaine($conn, $semaine, $recettes){
            $semaine = $semaine[0] ?? null;
            //echo(count($semaine));
            $tableau_nom_recettes = [];
            for ($i = 1; $i <= count($recettes); $i++) {
                //echo($i);
                $id = $semaine["id_plat_$i"];
                //echo($id);
                // var_dump($id);
                $recette = getRecetteById($conn, $id)['titre'];
                //var_dump($recette);
                $tableau_nom_recettes[] = $recette;
            }
            //var_dump($tableau_nom_recettes);
            return $tableau_nom_recettes;
        }


        $semaine = getSemaineByUser($conn,$user_id);
        // var_dump($semaine);
        //var_dump($recettes);
        if ($semaine){
            $recettes = getRecettesFavoris($conn, $user_id);
            if (count($recettes) < 14){
                deleteSemaine($conn,$user_id);
                echo("<h1>Vous n'avez pas assez de recettes en favoris !</h1>");
                $nb_recette_maquant = 14 - count($recettes);
                if ($nb_recette_maquant === 1){
                    echo("<br><h1>Il vous manque 1 recette favorite pour programmer une semaine complète.</h1>");
                }
                else {
                    echo("<br><h1>Il vous manque $nb_recette_maquant recettes favorites pour programmer une semaine complète.</h1>");
                }
            }
            else {
                $recettes = getRecettesFavorisFormat($conn, $user_id);
                // var_dump($semaine);
                $tableau_nom_recettes = get_semaine($conn, $semaine, $recettes);
                //var_dump($tableau_nom_recettes);
            }
        }
        else {
            $recettes = getRecettesFavoris($conn, $user_id);
            if (count($recettes) < 14){
                echo("<h1>Vous n'avez pas assez de recettes en favoris !</h1>");
                $nb_recette_maquant = 14 - count($recettes);
                if ($nb_recette_maquant === 1){
                    echo("<br><h1>Il vous manque 1 recette favorite pour programmer une semaine complète.</h1>");
                    }
                    else {
                    echo("<br><h1>Il vous manque $nb_recette_maquant recettes favorites pour programmer une semaine complète.</h1>");
                }
            }
            else {
                $recettes = getRecettesFavorisFormat($conn, $user_id);
                $recettes_shuffle = recettes_random($recettes);
                $p1 = $recettes_shuffle[0]['id_recette'];
                $p2 = $recettes_shuffle[1]['id_recette'];
                $p3 = $recettes_shuffle[2]['id_recette'];
                $p4 = $recettes_shuffle[3]['id_recette'];
                $p5 = $recettes_shuffle[4]['id_recette'];
                $p6 = $recettes_shuffle[5]['id_recette'];
                $p7 = $recettes_shuffle[6]['id_recette'];
                $p8 = $recettes_shuffle[7]['id_recette'];
                $p9 = $recettes_shuffle[8]['id_recette'];
                $p10 = $recettes_shuffle[9]['id_recette'];
                $p11 = $recettes_shuffle[10]['id_recette'];
                $p12 = $recettes_shuffle[11]['id_recette'];
                $p13 = $recettes_shuffle[12]['id_recette'];
                $p14 = $recettes_shuffle[13]['id_recette'];
                addSemaine($conn,$user_id,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14);
                
                $semaine = getSemaineByUser($conn,$user_id);
                $tableau_nom_recettes = get_semaine($conn, $semaine, $recettes);
                // var_dump($tableau_nom_recettes);
            }
        }
    ?>


    <script src="./js/semaine.js"></script>
    <script>
        let data = <?php echo json_encode($recettes); ?>;
        // console.log(data);
        let data_semaine = <?php echo json_encode($semaine); ?>;
        // console.log(data_semaine);
        
        let tableau_nom_recettes = <?php echo json_encode($tableau_nom_recettes); ?>;
        //console.log(tableau_nom_recettes);
        creer_tableau_semaine(tableau_nom_recettes);
        
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
    <script src="./js/semaine.js"></script>
</body>
</html>