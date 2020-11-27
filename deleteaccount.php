<?php
session_start();
include("connection.php");
include("constants.php");
include("utilityfunctions.php");


date_default_timezone_set("Africa/Kampala");

if(!isset($_SESSION["email"]) ){

header("location:".DOMAIN_LOGIN);


}
try{

$tag=$_SESSION["email"];
$un=$_SESSION["uname"];


$sql=$conn->prepare("DELETE FROM users where email=:tag");

$sql->execute(array('tag'=>$tag));




 $folder = "/dashboard/enterprises/".$un;

rrmdir($folder);

  
session_destroy(); 



header("location: ".DOMAIN_LOGIN);

}catch(Exception $e){
    
  header("location: ".ACCOUNT);
    
}









?>

		