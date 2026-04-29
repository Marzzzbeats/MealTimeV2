<?php
    require_once(__DIR__ . '/../lib/user_utils.php');

    function getNotifs($conn){
        //Récupère tous les notifications
        if(!$conn){
            header('Location: notifs.php?status=connError'); //Gestion d'erreur de connexion à la base =
        }
        $sql="SELECT * FROM notifs";
        $result = mysqli_query($conn, $sql);
        // if(!$result){
        //     header('Location: notifs.php?status=notifErr1'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de notifs.php)
        // }
        return rsToAssoc($result);
    }

    function getNotifbyID($conn, $id){
        //Réucupère un notification en conftion de son id
        if(!$conn){
            header('Location: notifs.php?status=connError');
        }
        $sql="SELECT * FROM notifs WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: notifs.php?status=notifErr2'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de notifs.php)
        }
        return rsToAssoc($result);
    }

    function getUserNotifs($conn, $user_id){
        //Réucupère un notification en conftion de son id
        if(!$conn){
            header('Location: notifs.php?status=connError');
        }
        $sql="SELECT * FROM notifs WHERE a = $user_id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: notifs.php?status=notifErr2'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de notifs.php)
        }
        return rsToAssoc($result);
    }

    function addNotif($conn, $de, $a, $type, $message){
        //Rajoute un notification à la bdd
        if(!$conn){
            header('Location: notifs.php?status=connError');
        }
        $sql="INSERT INTO notifs (`de`, `a`, `type`, `message`, `vu`) VALUES ('$de', '$a', '$type', '$message', 0)";
        $result=mysqli_query($conn, $sql);
        if(!$result){
            header('Location: notifs.php?status=notifErr3'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de notifs.php)
        }
        return $result;
    }

    function deleteNotif($conn, $id){
        //Supprime d'notification avec l'id $id de la bdd
        if(!$conn){
            header('Location: notifs.php?status=connError');
        }
        $sql="DELETE FROM notifs WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: notifs.php?status=notifErr4'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de notifs.php)
        }
        return $result;
    }

    function modifNotif($conn, $id, $de, $a, $type, $message, $vu){
        if(!$conn){
            header('Location: notifs.php?status=connError');
        }
        $sql = "UPDATE notifs SET `de`='$de', `a`='$a', `type`='$type', `message`='$message', `vu`='$vu' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: notifs.php?status=notifErr5'); //Gestion d'erreur de requêtre SQL (se referer à la section gestion d'erreurs de notifs.php)
        }
        return $result;
    }
    
    function markAsRead($conn, $id){
        if(!$conn){
            header('Location: notifs.php?status=connError');
        }
        $sql = "UPDATE notifs SET `vu`='1' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header('Location: notifs.php?status=notifErr5');
            }
        return $result;
    }

    function notifFollowRequest($conn, $from, $to){
        $message = "vous s'est abonné à votre compte";
        return addNotif($conn, $from, $to, "followRequest", $message);
    }

    function notifFollowAccepted($conn, $from, $to){
        $message = "a accepté votre demande";
        return addNotif($conn, $from, $to, "followAccepted", $message);
    }

    function notifNewRecipe($conn, $from, $to){
        $message = "a publié une nouvelle recette";
        return addNotif($conn, $from, $to, "newRecipe", $message);
    }

    function notifDeletedRecipe($conn, $to){
        $message = "une de vos recettes a été supprimée";
        return addNotif($conn, 0, $to, "deletedRecipe", $message);
    }
    

    function getUnreadNotifs($conn, $user_id){
        $sql="SELECT * FROM notifs WHERE a = $user_id AND vu = 0 ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        return rsToAssoc($result);
    }
?>