<?php
    include './db/db_connect.php';
    include './lib/user_utils.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MealTime</title>
</head>
<body>
    <?php
        /* Table des gestions d'erreurs (à implementer dans les contrôleurs GET):
        status=connError : Erreur de connexion à la base
        status=userErr1 : Impossible de récuperer les utilisateurs dans user
        status=userErr2 : Impossible de récuperer le user avec l'id $id
        status=userErr3 : Impossible de créer le user
        status=userErr4 : Impossible de supprimer le user avec l'id $id
        status=userErr5 : Impossible de modifier le user avec l'id $id
        */
    ?>
</body>
</html>
<?php
    include './db/db_disconnect.php';
?>