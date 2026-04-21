<?php

    function pwordOk($password1, $password2){
        //Vérifie si le mot de passe est confirmé
        $res = false;
        if($password1 == $password2){
            $res = true;
        }
        return $res;
    }

?>