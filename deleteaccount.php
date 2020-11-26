<?php
session_start();
include("connection.php");
include("constants.php");
include("utilityfunctions.php");

if(!isset($_SESSION["email"]) ){

header("location:http://localhost:12345/site/userlogin.php");


}
try{

$tag=$_SESSION["email"];
$un=$_SESSION["uname"];


$sql=$conn->prepare("DELETE FROM users where email=:tag");

$sql->execute(array('tag'=>$tag));




 $folder = "/dashboard/enterprises/".$un;

rrmdir($folder);

  
session_destroy(); 



header("location: http://localhost:12345/site/userlogin.php");

}catch(Exception $e){
    
  header("location: http://localhost:12345/site/useraccount.php");
    
}









?>

		