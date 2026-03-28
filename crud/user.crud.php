<?php
    include './lib/user_utils.php';

    function getUsers($conn){
        //Récupère tous les utilisateurs
        if(!$conn){
            header('Location: index.php?status=connError'); //Gestion d'erreur de connexion à la base =
        }
        $sql="SELECT * FROM user";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr1'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return rsToAssoc($result);
    }

    function getUserById($conn, $id){
        //Réucupère un utilisateur en conftion de son id
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql="SELECT * FROM user WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr2'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return rsToAssoc($result);
    }

    function addUser($conn, $email, $nom, $prenom, $password, $profile_pic, $id_abo, $preferences, $allergies){
        //Rajoute un utilisateur à la bdd
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $ashed = $ashPassword($password);
        $sql="INSERT INTO user (`email`, `nom`, `prenom`, `password`, `profile_pic`, `id_abo`, `preferences`, `allergies`) VALUES ('$email', '$nom', '$prenom', '$ashed', $profile_pic, $id_abo, $preferences, $allergies)";
        $result=mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr3'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }

    function deleteUser($conn, $id){
        //Supprime d'utilisateur avec l'id $id de la bdd
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql="DELETE FROM user WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr3'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }
?>