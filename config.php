<?php 
$server_name='localhost';
$user_name='root';
$password='';
try{
$con=new pdo("mysql:host=$server_name;dbname=testapp",$user_name,$password);
$con->setATTRIBUTE(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    echo $e->getmessage.'$$ faild conect on line '.$e->getline();
}





