<?php
$conn = mysqli_connect("localhost" , "grp9", "pohm2Ein" , "db_grp9");
if(!$conn){
    echo("Err de conneexion");
}
mysqli_set_charset($conn, "utf8");
?>
