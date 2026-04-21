<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../crud/recettes.crud.php');
    require_once(__DIR__ . '/../db/db_connect.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $image = getImageRecette($conn, $id);
        if($image['image'] == null){
            header("Content-Type: image/jpeg");
            readfile('../public/img/placeholder.jpeg');
        }else{
            header("Content-Type: image/jpeg");
            $data = $image['image'];
            echo($data);
        }
    }
?>