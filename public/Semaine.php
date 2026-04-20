<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MA SEMAINE</title>
    <link rel="stylesheet" href="./css/semaine.css">

</head>
<body>
    <?php
        require_once(__DIR__ . '/../db/db_connect.php');
        require_once(__DIR__ . '/../crud/favoris.crud.php');
        $user_id = 4;
        require_once(__DIR__ . '/../crud/semaine.crud.php');
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        #$user_id = $_SESSION['id']; 
        $user_id = 4;
        $recettes = getRecettesFavFormat($conn, $user_id);
        $semaine = getSemaineByUser($conn,$user_id);
        if (!empty($semaine)) {
            $p1 = $semaine['id_plat_1'];
            $p2 = $semaine['id_plat_2'];
            $p3 = $semaine['id_plat_3'];
            $p4 = $semaine['id_plat_4'];
            $p5 = $semaine['id_plat_5'];
            $p6 = $semaine['id_plat_6'];
            $p7 = $semaine['id_plat_7'];
            $p8 = $semaine['id_plat_8'];
            $p9 = $semaine['id_plat_9'];
            $p10 = $semaine['id_plat_10'];
            $p11 = $semaine['id_plat_11'];
            $p12 = $semaine['id_plat_12'];
            $p13 = $semaine['id_plat_13'];
            $p14 = $semaine['id_plat_14'];
        } 
        else {
            $p1 = $recettes[0]['id_recette'];
            $p2 = $recettes[1]['id_recette'];
            $p3 = $recettes[2]['id_recette'];
            $p4 = $recettes[3]['id_recette'];
            $p5 = $recettes[4]['id_recette'];
            $p6 = $recettes[5]['id_recette'];
            $p7 = $recettes[6]['id_recette'];
            $p8 = $recettes[7]['id_recette'];
            $p9 = $recettes[8]['id_recette'];
            $p10 = $recettes[9]['id_recette'];
            $p11 = $recettes[10]['id_recette'];
            $p12 = $recettes[11]['id_recette'];
            $p13 = $recettes[12]['id_recette'];
            $p14 = $recettes[13]['id_recette'];
        }

    ?>
    <script>
        let data = <?php echo json_encode($recettes); ?>;
        let data_semaine = <?php echo json_encode($semaine); ?>;
        console.log(data_semaine);
    </script>
    <script src="./js/semaine.js"></script>


    <form action="semaine.php" method="POST">
        <input type="hidden" name="action" value="add">
        <button type="submit">Afficher</button>
    </form>

</body>

</html>