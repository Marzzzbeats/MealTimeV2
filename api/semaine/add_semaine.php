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
$data = json_decode(file_get_contents("php://input"), true);


addSemaine($conn,$user_id,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14);

?>