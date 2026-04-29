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
$saison = $_GET["saison"];
$prix = $_GET["prix"];
$sante = $_GET["sante"];
$recettes = getRecettesFavoris($conn, $user_id, $saison, $prix, $sante);
echo(json_encode($recettes));


?>