<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once(__DIR__ . '/../../crud/user.crud.php');
    require_once(__DIR__ . '/../../db/db_connect.php');

    if (ob_get_level()) {
        ob_clean();
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $image = getProfilePic($conn, $id);
        header("Content-Type: image/jpg");
        if(empty($image) || empty($image[0]['image'])){
            header("Cache-Control: no-cache, must-revalidate");
            readfile(__DIR__ . '/../../public/img/photodeprofil.jpg');
            exit;
        }else{
            $data = $image[0]['image'];
            echo($data);
        }
    }
?>