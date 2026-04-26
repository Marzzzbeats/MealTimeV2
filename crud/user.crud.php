<?php
    require_once(__DIR__ . '/../lib/user_utils.php');
    require_once(__DIR__ . '/../lib/auth_utils.php');

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
        $sql="SELECT id, email, nom, prenom, `role`, active FROM user WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo('Erreur de bdd');
        }
        return rsToAssoc($result);
    }


    function addUser($conn, $email, $nom, $prenom, $password, $profile_pic){
    
		if($profile_pic == ""){
			$profile_pic = null;
		}
        $ashed = ashPassword($password);
		$sql = "INSERT INTO user (`email`, `nom`, `prenom`, `password`, `profile_pic`) 
				VALUES (?, ?, ?, ?, ?)";
				
		$stmt = mysqli_prepare($conn, $sql);
		$null_blob = null; 
		mysqli_stmt_bind_param($stmt, "ssssb", $email, $nom, $prenom, $ashed, $null_blob);
		if($profile_pic !== null){
			mysqli_stmt_send_long_data($stmt, 4, $profile_pic);
		}
		$res = mysqli_stmt_execute($stmt);
		return $res; 
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
        $user=rsToAssoc($result);
        return $user[0];
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
    
    function isActive($conn, $id){
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
        if($tab_res[0]['active'] == 1){
            $res = true;
        }
        return $res;
    }

    function getProfilePic($conn, $id){
		$sql = "SELECT `profile_pic` FROM user WHERE id=$id";
		$res = mysqli_query($conn, $sql);
		$tab = rsToAssoc($res);
		return $tab; 
	}

    function modifNomUser($conn, $id, $nom, $prenom){
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql = "UPDATE user SET `nom`='$nom', `prenom`='$prenom' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    function modifEmailUser($conn, $id, $email){
        if(!$conn){
            header('Location: index.php?status=connError');
        }
        $sql = "UPDATE user SET `email`='$email' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    function modifMdp($conn, $id, $password){
        $ashed = ashPassword($password);
        $sql = "UPDATE user SET `password`='$ashed' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
?>