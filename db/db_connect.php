<?php

function connection(){
    $connn = mysqli_connect("localhost", "grp9", "pohm2Ein", "db_grp9");
    mysqli_set_charset($connn, "utf8");
    return $connn;
};

?>