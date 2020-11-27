<?php
session_start();

if(!isset($_SESSION["email"]) ){

header("location:".DOMAIN_LOGIN);


}

session_destroy(); 


header("location:".DOMAIN_LOGIN);
?>

		