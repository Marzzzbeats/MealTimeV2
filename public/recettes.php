<?php
    require_once(__DIR__ . '/../db/db_connect.php');
    require_once(__DIR__ . '/../crud/recettes.crud.php');
    require_once(__DIR__ . '/../api/api_recettes.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes recettes</title>
</head>
<body>
    <div>
        <h2>Mes recettes favorites</h2>
        <div id="fav">

        </div>
    </div>
    <div>
        <h2>Les recettes que j'ai créé</h2>
        <div id="created">

        </div>
    </div>

    <button id="create">Créer une recette</button>

    <div id=popup_creation_form>
        <div id="formc">

        </div>
    </div>

</body>
</html>
<?php
    require_once(__DIR__ . '/../db/db_disconnect');
?>