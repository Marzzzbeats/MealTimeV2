<?php

function strQteToList($str_abo){
    $list_abo=array();
    $str="";
    for($i; $i<strlen($str_abo); $i++){
        if($str_abo[$i] != " "){
            $str.=$str_abo[$i];
        }else{
            $list_abo[] = $str;
            $str="";
        }
    }
    return $list_abo;
}


?>