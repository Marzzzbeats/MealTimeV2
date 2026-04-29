<?php
require_once(__DIR__ . '/../../db/db_connect.php');
require_once(__DIR__ . '/../../crud/favoris.crud.php');
require_once(__DIR__ . '/../../crud/semaine.crud.php');
require_once(__DIR__ . '/../../crud/recettes.crud.php');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');


header("Content-Type: application/json");

$user_id = $_GET['user_id'];
$semaine = $_GET['semaine'];
$recette = json_decode($_GET['recettes']);

$semaine = $semaine[0] ?? null;
$tableau_id_recettes = [];
for ($i = 1; $i <= 14; $i++) {
    $id = $semaine["id_plat_$i"];
    $tableau_id_recettes[] = $id;
}
echo(json_encode($tableau_id_recettes));

?>