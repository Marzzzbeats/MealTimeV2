<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include "/home/perivolas/public_html/mealtime/db/db_connect.php"; 
    include "/home/perivolas/public_html/mealtime/crud/user.crud.php"; 

    $conn = connection();

    header('Content-Type: application/json');

?>

<?php
$id = $_GET["user_id"];
$data = getUserById($conn, $id);
if($id == 0){
    $username = "Mealtime";
}elseif($data == null){
    $username = "Unknown";
}else{
    $username = $data[0]['prenom'];
}
echo($username);

?>