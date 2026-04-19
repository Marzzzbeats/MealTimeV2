<?php
    function rsToAssoc($rs){
        //Change un résultSet en tableau associatif
        $tab=[] ; 
        while($row=mysqli_fetch_assoc($rs)){
            $tab[]=$row ;	
        }
        return $tab;
    }

    function ashPassword($clear_password){
        //Chiffre le mot de passe afin de ne pas le stocker en clair dans la bdd
        $ash_pass = password_hash($clear_password, PASSWORD_DEFAULT);
        return $ash_pass;
    }

    function checkPassword($pass, $ashed_pass){
        //Vérifie si le mot de passe correspond bien au ash du mdp
        $res=password_verify($pass, $ashed_pass);
        return $res;
    }

?>