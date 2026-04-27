<?php
require_once(__DIR__ . '/../../db/db_connect.php');
require_once(__DIR__ . '/../../crud/favoris.crud.php');
session_start();
header("Content-Type: application/json");

$user_id = $_GET['user_id'];
// On utilise getRecettesFavorisR qui joint favoris + recettes
$recettes = getRecettesFavorisR($conn, $user_id);
echo json_encode($recettes);
?>