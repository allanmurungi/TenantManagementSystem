<?php
session_start();

if(!isset($_SESSION["un"]) ){

header("location:".DOMAIN_LOGIN);


}

session_destroy(); 


header("location:".DOMAIN_LOGIN);
?>

		