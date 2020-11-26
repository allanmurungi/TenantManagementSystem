<?php
session_start();

if(!isset($_SESSION["un"]) ){

header("location:http://localhost:12345/site/userlogin.php");


}

session_destroy(); 


header("location:http://localhost:12345/site/userlogin.php");
?>

		