<?php

    function getUserById($conn, $id){
        //Réucupère un utilisateur en conftion de son id
        if(!$conn){
            header('Location: user.crud.php?status=connError');
        }
        $sql="SELECT * FROM user WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo('Erreur de bdd');
        }
        return rsToAssoc($result);
    }

    function rsToAssoc($rs){
        //Change un résultSet en tableau associatif
        $tab=[] ; 
        while($row=mysqli_fetch_assoc($rs)){
            $tab[]=$row ;	
        }
        return $tab;
    }

?>