<?php
session_start();

include("../connection.php");
include("../connection2.php");
include("../constants.php");
include("../utilityfunctions.php");



date_default_timezone_set("Africa/Kampala");

if(!isset($_SESSION["email"]) ){

	header("location:".DOMAIN_LOGIN);
	
	
	}



if(!isset( $_POST['invoice'] )){

$due=$_POST['due'];
$issued=$_POST['issued'];
$amount=$_POST['rent'];
$r_unit=$_POST['r_unit'];
$names=$_POST['names'] ;

}else{

  header("location:".HOME);

}

$html = '
<html>
<head
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="Admin" />
		<meta name="keywords" content="Admin, Dashboard" />
		<meta name="author" content="Allan M" />
		<link rel="shortcut icon" href="img/favicon.ico">
<title>Invoice</title>
<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" media="screen" rel="stylesheet" />

		<!-- Main CSS -->
		<link href="css/main.css" rel="stylesheet" media="screen" />

		<!-- Ion Icons -->
		<link href="fonts/icomoon/icomoon.css" rel="stylesheet" />
		
		<!-- C3 CSS -->
		<link href="css/c3/c3.css" rel="stylesheet" rel="stylesheet" />

		<!-- Circliful CSS -->
		<link href="css/circliful/circliful.css" rel="stylesheet" />

		<!-- Data Tables -->
		<link rel="stylesheet" href="css/datatables/dataTables.bs.min.css">
		<link rel="stylesheet" href="css/datatables/autoFill.bs.min.css">
		<link rel="stylesheet" href="css/datatables/fixedHeader.bs.css">
    <style>
    
  body{
  
  background-image: url("img/re1.jpg");
  background-image-resize:6;
  }
  

</head>

<body>
<!-- Row starts -->
<div class="row gutter">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <p><b>Biller</b></p>
  <hr/>
  <p><b>Landlord:</b> </p>
  '.Company.'
  <p><b>Address:</b></p>
  '.Address.'
  <p><b>phone:</b></p>
  '.Phone.'
  <p><b>Email:</b></p>
  '.Email.'
  <hr/>
  <p><b>Billed To</b></p>
  <hr/>
  <p><b>Names:</b></p>
  '.$names.'
  <p><b>Rent Unit:</b></p>
  '.$r_unit.'
  <p><b>Date Issued:</b></p>
  '.$issued.'
  <p><b>Date Due:</b></p>
  '.$due.'
  <hr/>
  <p><b>Bill</b></p>
  <hr/>
  <p><b>Amount Due:</b></p>
  '.$amount.'
  <hr/>
  <p>Landlord signature: </p>
  
  <p>-----------------------------------------------------------------------------------------------------------------</p>


  </div>
  
</div>
<!-- Row ends -->


</body>
</html>

';


//==============================================================
//==============================================================
//==============================================================

require_once 'mpdf/vendor/autoload.php';
$mpdf = new mPDF('c');

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


