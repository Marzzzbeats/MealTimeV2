<?php


function addTicket($conn, $user_id, $category, $title, $message, $date){
    $sql = "INSERT INTO tickets (user_id, category, titre, message, date) VALUES ('$user_id', '$category', '$title', '$message', '$date')";
    return mysqli_query($conn, $sql);
}

function getAllTickets($conn){
    $sql = "SELECT * FROM tickets";
    $result = mysqli_query($conn, $sql);
    return rsToAssoc($result);
}

function getUserTickets($conn, $user_id){
    $sql = "SELECT * FROM tickets WHERE user_id = $user_id ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    return rsToAssoc($result);
}

function deleteTicket($conn, $id){
    $sql="DELETE FROM tickets WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return $result;
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