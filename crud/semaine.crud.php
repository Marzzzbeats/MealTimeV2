<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
require_once(__DIR__ . '/../lib/user_utils.php');

$debug = false;



function addSemaine($conn,$user_id,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14){
$sql = "INSERT INTO semaine (id_user,id_plat_1,id_plat_2,id_plat_3,id_plat_4,id_plat_5,id_plat_6,id_plat_7,id_plat_8,id_plat_9,id_plat_10,id_plat_11,id_plat_12,id_plat_13,id_plat_14)
VALUES ($user_id,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14)";
global $debug; if($debug) echo $sql;
return mysqli_query($conn,$sql);
}


function updateSemaine($conn,$id,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14){
$sql = "UPDATE semaine SET id_plat_1=$p1,id_plat_2=$p2,id_plat_3=$p3,id_plat_4=$p4,id_plat_5=$p5,id_plat_6=$p6,id_plat_7=$p7,id_plat_8=$p8,id_plat_9=$p9,id_plat_10=$p10,id_plat_11=$p11,id_plat_12=$p12,id_plat_13=$p13,id_plat_14=$p14 WHERE id=$id";
global $debug; if($debug) echo $sql;
return mysqli_query($conn,$sql);
}


function deleteSemaine($conn,$id){
$sql = "DELETE FROM semaine WHERE id=$id";
global $debug; if($debug) echo $sql;
return mysqli_query($conn,$sql);
}


function getSemaine($conn){
$sql = "SELECT * FROM semaine";
$res = mysqli_query($conn,$sql);
return rsToAssoc($res);
}


function getSemaineByUser($conn,$user_id){
$sql = "SELECT * FROM semaine WHERE id_user=$user_id";
$res = mysqli_query($conn,$sql);
return rsToAssoc($res);
}

?>