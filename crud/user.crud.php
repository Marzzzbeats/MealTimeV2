<?php
    require_once '../lib/user_utils.php';

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
        $ashed = ashPassword($password);
        $sql="INSERT INTO user (`email`, `nom`, `prenom`, `password`, `profile_pic`, `id_abo`, `preferences`, `allergies`, `role`) VALUES ('$email', '$nom', '$prenom', '$ashed', $profile_pic, $id_abo, $preferences, $allergies, 'user')";
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
            header('Location: index.php?status=userErr4'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }

    function modifUser($conn, $id, $nom, $prenom, $profile_pic){
        //Modifie le gère la modification du nom, du prénom et de la photo de profil du client
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql = "UPDATE user SET `nom`='$nom', `prenom`='$prenom', `profile_pic`='$profile_pic' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr5'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }

    function getAbo($conn, $id){
        //Récupère les id des abonnements du client sous forme de tableau
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql = "SELECT id_abo FROM user WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr6'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        $res=rsToAssoc($result);
        return strAboToList($res['id_abo']);
    }

    function addAbo($conn, $id_nabo, $id){
        //Ajoute un id aux abonnements du client
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $str_abo = listToStr(getAbo($conn, $id));
        $nsrt_abo = newAbo($str_abo, "$id_nabo");
        $sql = "UPDATE user SET `id_abo`=$nsrt_abo WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr7'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }

    function getPreferences($conn, $id){
        //Récupère les preferences d'un client
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql = "SELECT preferences FROM user WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr8'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        $res=rsToAssoc($result);
        return strAboToList($res['preferences']);
    }

    function addPreferences($conn, $id, $npref){
        //Ajoute un e preference aux preferences du client
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $str_pref = listToStr(getPreferences($conn, $id));
        $nsrt_pref = newAbo($str_pref, "$npref");
        $sql = "UPDATE user SET `preferences`=$nstr_pref WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr9'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }

    function getAllergies($conn, $id){
        //Récupère les allergies d'un client
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql = "SELECT allergies FROM user WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr8'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        $res=rsToAssoc($result);
        return strAboToList($res['allergies']);
    }

    function addAllergies($conn, $id, $nallergie){
        //Ajoute une allergie au client
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $str_allergie = listToStr(getAllergies($conn, $id));
        $nstr_allergie = newAbo($str_allergie, "$nallergie");
        $sql = "UPDATE user SET `allergies`=$nstr_allergie WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr9'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }

    function setUserActive($conn, $id){
        //Set l'user à active
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql="UPDATE user SET `active`=1 WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr10'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }

    function setUserInactive($conn, $id){
        //Set l'user à active
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql="UPDATE user SET `active`=0 WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: index.php?status=userErr11'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de index.php)
        }
        return $result;
    }

    function getUserByEmail($conn, $email){
        //Réucupère un utilisateur en conftion de son id
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql="SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: public/login.php?status=userNull'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de login.php)
        }
        return rsToAssoc($result);
    }

    function getRole($conn, $id){
        //récupère le rôle du client
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql="SELECT `role` FROM user WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: public/login.php?status=userNull'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de login.php)
        }
        return rsToAssoc($result);
    }
    
    function isAcive($conn, $id){
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql = "SELECT `active` FROM user WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $tab_res = rsToAssoc($result);
        $res = false;
        if(!$result){
            header('Location: public/login.php?status=userDisconnected'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de login.php)
        }
        if($tab_res['active'] == 1){
            $res = true;
        }
        return $res;
    }

?>