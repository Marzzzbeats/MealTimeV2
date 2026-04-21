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
        require_once(__DIR__ . '/../crud/semaine.crud.php');
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        #$user_id = $_SESSION['id']; 
        $user_id = 4;
        $recettes = getRecettesFavFormat($conn, $user_id);
        $semaine = getSemaineByUser($conn,$user_id);
        if (!$semaine) {

            shuffle($recettes);

            $p1 = $recettes[0]['id_recette'];
            $p2 = $recettes[0]['id_recette'];
            $p3 = $recettes[0]['id_recette'];
            $p4 = $recettes[0]['id_recette'];
            $p5 = $recettes[0]['id_recette'];
            $p6 = $recettes[0]['id_recette'];
            $p7 = $recettes[0]['id_recette'];
            $p8 = $recettes[0]['id_recette'];
            $p9 = $recettes[0]['id_recette'];
            $p10 = $recettes[0]['id_recette'];
            $p11 = $recettes[0]['id_recette'];
            $p12 = $recettes[0]['id_recette'];
            $p13 = $recettes[0]['id_recette'];
            $p14 = $recettes[0]['id_recette'];
            echo($p1);
            echo($p5);

            addSemaine($conn,$user_id,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14);

            $semaine = getSemaineByUser($conn,$user_id)[0];
        }
        else {
            
        }








    ?>
    <script>
        let data = <?php echo json_encode($recettes); ?>;
        let data_semaine = <?php echo json_encode($semaine); ?>;
    </script>
    <script src="./js/semaine.js"></script>


</body>

</html>