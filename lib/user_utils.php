<?php
    function rsToAssoc($rs){
        //Change un résultSet en tableau associatif
        $tab=[] ; 
        while($row=mysqli_fetch_assoc($rs)){
            $tab[]=$row;	
        }
        return $tab;
    }

    function newAbo($str_abo, $id_abo){
        $str_abo.=",$id_abo";
        return $str_abo;
    }

    function strToList($str){
        // Transforme un str de type "Salade, Tomates, oignons jaunes" en Array([0]=>Salade [1]=>Tomate [2]=>Oignons jaunes )
        $list=array();
        $str_res="";
        for($i; $i<strlen($str); $i++){
            if($str[$i] != "," && $i != strlen($str)-1){
                $str_res.=$str[$i];
            }else{
                if($i == strlen($str)-1){
                    $str_res.=$str[$i];
                }
                $list_abo[] = $str_res;
                $str_res="";
                $i++; //Evite les espaces après les virgules
            }
        }
        return $list_abo;
    }

    function listToStr($list){
        $str_elt="";
        foreach($list as $elt){
            $str_elt.=" $elt";
        }
        return $str_elt;
    }

?>