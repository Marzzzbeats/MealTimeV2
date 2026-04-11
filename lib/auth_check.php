<?php
    session_start();
    require_once(__DIR__ . '/../crud/user.crud.php');
    $res = [
        "connected" => false;
        "active" => false;
        "user" => null
    ];
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $user = getUserById($conn, $id);
        if(!tokenExpired()){
            if($user){
                $res["connected"] = true;
                $res['user'] = $user;
            };

            if(isActive($conn, $id)){
                $res['active'] = true;
            }
        }
    }

    echo(json_encode($res));
?>