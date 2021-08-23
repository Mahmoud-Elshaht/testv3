<?php
global $con;
// <=====================================================================================>
// <== func for print page titel if Variable '$page_title' in page =======>
function get_title() {
    global $page_title;
    if(isset($page_title)){
        echo $page_title;
    }else{echo 'defualt';}
}// <=== End func get title =======>

// <=====================================================================================>
// check item check if item in database or no
//  check item function [this function accept parameter]
//    $select = the item to select     
//    $from   = the table name 
 //   $value = the value of select 

    function check_item($select, $from, $value){
        global $con;
        $stmt=$con->prepare("SELECT $select FROM $from WHERE $select=?");
        $stmt->execute(array($value));
        $count=$stmt->rowcount();
        return $count;
    }//END check item function  
//<===================================================================================>
// to select data from data base 
// $item => accept name of culomn in db
// $table => accept name of table in db
//$s_cul => mean culom name the data will fetch by this value
function select($item,$table,$s_cul=0,$value=0){
    global $con;
    $query=$con->prepare("SELECT $item FROM $table where $s_cul=? ");
  $query->execute(array($value));
  $content=$query->fetchall();
 return $content;
}
// <============================================================================>
    function delete($table,$value){
        global $con;
        $stmt=$con->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute(array($value));
}
// =====================================================================
