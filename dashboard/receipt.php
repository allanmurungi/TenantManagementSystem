<?php
session_start();

include("../connection.php");
include("../connection2.php");
include("../constants.php");
include("../utilityfunctions.php");

date_default_timezone_set("Africa/Kampala");

if(!isset($_SESSION["email"]) ){

	header("location:http://localhost:12345/site/userlogin.php");
	
	
	}



if(!isset( $_POST['invoice'] )){

    
    $issued=$_POST['issued'];
    $unit_price=$_POST['rent'];
    $r_unit=$_POST['r_unit'];
	$names=$_POST['names'] ;
	$other=$_POST['other'] ;
    $ref_num = randomNumber(6);
    
    $amount=$_POST['amount'];
    $cur=$_POST['cur'];
    $id=$_POST['id'];

}else{

  header("location:http://localhost:12345/site/dashboard/home.php");

}




$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>

<div style="text-align: right">Date: 13th November 2008</div>

<table width="100%" style="font-family: serif;" cellpadding="10"><tr>
<td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;"><b>Biller:</b></span><br /><br />
'.Company.'<br/>
'.Address.'<br />
'.Phone.'<br />
'.Email.'
</td>
<td width="10%">&nbsp;</td>
<td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;"><b>Billed To:</b></span><br /><br />
<b>Names:</b> '.$names.'<br/>
<b>Other names:</b> '.$other.'<br/>
<b>Issued on</b> '.date('d-m-y').'<br/>
</td>
</tr></table>
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="15%">Ref. No.</td>
<td width="10%">Tenant id</td>
<td width="45%">Rental Unit</td>
<td width="15%">Unit Price</td>
<td width="15%">Amount</td>
</tr>
</thead>
<tbody>

<!-- ITEMS HERE -->
<tr>
<td align="center">'.$ref_num.'</td>
<td align="center">'.$id.'</td>
<td>'.$r_unit.'</td>
<td class="cost">'.$cur.' '.$unit_price.'</td>
<td class="cost">'.$cur.' '.'........'.'</td>
</tr>
<!-- END ITEMS HERE -->

</tbody>
</table>
<div style="text-align: cente
r; font-style: italic;">'.terms.'</div>
</body>
</html>
';

//$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
//require_once $path . '/vendor/autoload.php';

require_once 'mpdf/vendor/autoload.php';
$params = array(
	
);

$mpdf = new mPDF();

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle(Company." - Receipt");
$mpdf->SetAuthor(Company);
$mpdf->SetWatermarkText("Paid in Full");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.2;
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);

$mpdf->Output();
