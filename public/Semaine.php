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
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        #$user_id = $_SESSION['id']; 
        $user_id = 2;
        $recettes = getRecettesFavFormat($conn, $user_id);
        var_dump($recettes[0]['titre']);
    ?>

    <script src="./js/semaine.js"></script>
</body>

</html>