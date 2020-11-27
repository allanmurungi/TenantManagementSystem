<?php
session_start();


include("../connection.php");
include("../constants.php");
include("../utilityfunctions.php");

include("../connection2.php");


if(!isset($_SESSION["un"]) ){

header("location:".DOMAIN_LOGIN);


}

session_destroy(); 


header("location:".DOMAIN_LOGIN);
?>

		