<?php
    require_once(__DIR__ . '/../crud/user.crud.php');
    require_once(__DIR__ . '/user_utils.php');
    require_once(__DIR__ . '/auth_utils.php');
    
    function isUser($conn, $email, $password){
        //Vérifie si un user existe bien
        $res=false;
        $user = getUserByEmail($conn, $email);

        if($user == []){
            header('Location: login.php?status=userNull');
        }else{
            $pwd_ok = checkPassword($password, $user['password']);

            if(!$pwd_ok){
                header('Location: login.php?status=pwdFalse');
            }else{
                $res=true;
            }
        }
        return $res;
    }

?>