<?php
    session_start();
    include '../db/db_connect.php';
    include '../db/db_connect.php';
    require_once '../crud/user.crud.php';
    require_once '../lib/login_utils.php';
    require_once '../lib/user_utils.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div id='register_form'></div>
    <p>Déjà membre ? <a href="./login.php">Se connecter</a></p>
</body>
</html>
<script src="./js/register.js"></script>

<?php
    include '../db/db_disconnect.php';
?>