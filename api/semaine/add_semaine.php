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

$user_id = $data["user_id"];
$p1 = $data["p1"];
$p2 = $data["p2"];
$p3 = $data["p3"];
$p4 = $data["p4"];
$p5 = $data["p5"];
$p6 = $data["p6"];
$p7 = $data["p7"];
$p8 = $data["p8"];
$p9 = $data["p9"];
$p10 = $data["p10"];
$p11 = $data["p11"];
$p12 = $data["p12"];
$p13 = $data["p13"];
$p14 = $data["p14"];


addSemaine($conn,$user_id,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14);

?>