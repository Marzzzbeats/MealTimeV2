<?php
    session_start();
    require_once('./user.crud.php');
    require_once('./db/db_connect.php');

    $res = [
        "connected" => false,
        "active" => false,
        "user" => null
    ];

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $user = getUserById($conn, $id);
        if(!tokenExpired($conn)){
            if($user){
                $res["connected"] = true;
                $res['user'] = $user[0];
            }

            if(isActive($conn, $id)){
                $res['active'] = true;
            }
        }
    }

    echo(json_encode($res));

    require_once(__DIR__ . '/../db/db_disconnect.php');
?>