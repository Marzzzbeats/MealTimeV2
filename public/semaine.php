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
        require_once(__DIR__ . '/../crud/recettes.crud.php');
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        #$user_id = $_SESSION['id']; 
        $user_id = 4;
        $recettes = getRecettesFavFormat($conn, $user_id);
        $semaine = getSemaineByUser($conn,$user_id);
        // var_dump($semaine);
        $semaine = $semaine[0] ?? null;
        $tableau_nom_recettes = [];
        for ($i = 1; $i <= count($recettes); $i++) {
            $id = $semaine["id_plat_$i"];
            // var_dump($id);
            $recette = getRecetteById($conn, $id)['titre'];
            $tableau_nom_recettes[] = $recette;
        }

/*
        else {
            echo("<script> 
                    let data = <?php echo json_encode($recettes); ?>; 
                    recettes_random(data);
                </script>");
        }
*/
    ?>



    <script>
        let data = <?php echo json_encode($recettes); ?>;
        let data_semaine = <?php echo json_encode($semaine); ?>;
        // console.log(data_semaine);
        let tableau_nom_recettes = <?php echo json_encode($tableau_nom_recettes); ?>;
        // console.log(tableau_nom_recettes);
    </script>

    <ul>
            <li><a href="./profil.php">Profil</a></li>
            <li><a href="./recettes.php">Favoris</a></li>
            <li><a href="../index.php">Accueil</a></li>
            <li class="selected"><a href="./semaine.php">Semaine</a></li>
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
