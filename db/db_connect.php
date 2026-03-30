<?php
/*
    error_reporting(E_ALL);
    ini_set('display_errors','1');
*/
    $conn=mysqli_connect("localhost","grp9","pohm2Ein","db_grp9");
    mysqli_set_charset($conn,"utf8");
/*
        $result=mysqli_query($conn,"select * from TD2");
    echo("<pre>\n");
    while($row=mysqli_fetch_assoc($result)){
    print_r($row);
    print($row["id"]);
    }
    echo("</pre>\n");
            
    mysqli_close($conn);
*/      

?>