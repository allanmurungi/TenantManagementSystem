<?php 
session_start();

include '../connection2.php';
include '../connection.php';
include '../constants.php';
include '../utilityfunctions.php';

if(!isset($_SESSION['email'])){
//redirect
header("location:logout.php");
}

$conn=$conn2;
$table_name="";
if(!isset(  $_SESSION['location'] ) && isset($_POST['location'])){

$table_name = $_POST['location'];
$_SESSION['location']=$table_name;
unset($_POST['location']);

}
elseif(isset($_SESSION['location'] ) && isset($_POST['location'])){

$table_name = $_POST['location'];
$_SESSION['location']=$table_name;
unset($_POST['location']);

}
else{
	

	$table_name = 	$_SESSION['location'];

}

//get the tenants
$sql_pdts = "SELECT id,renew_date FROM ".$table_name;
$result_pdts= mysqli_query($conn, $sql_pdts);
$tnts = mysqli_num_rows($result_pdts);


 
//get totals
$tenants = 0;
$reds = 0;
$oranges = 0;
$blues = 0;
$greens = 0;
$color_response="";

try{
								
	while($row = mysqli_fetch_array($result_pdts)){

		if( sizeof($row)>0 ){
		$latest_date=$row['renew_date'];
		
		$color_response=getsubdate($latest_date);
		//echo $color_response."";
		

		if( $color_response == "red"){

			$reds= $reds+1;

		}elseif($color_response == "orange"){

			$oranges= $oranges+1;
		}
		elseif($color_response == "blue"){

			$blues= $blues+1;
		}
		elseif($color_response == "green"){

			$greens= $greens+1;
		}else{

			//echo "error found";
		}

	}
	}//end of while
	
}catch(Exception $e){
	//	echo $e	;					    
								    
}


?>
<!DOCTYPE html>
<html lang="en">
	
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="Admin" />
		<meta name="keywords" content="Admin" />
		<meta name="author" content="" />
		<link rel="shortcut icon" href="img/favicon.ico">
		<title><?php echo Company; ?></title>
		
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

		<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
<style>

#d_wrapper{

background-image: url("img/re1.jpg");
background-repeat: no-repeat;
background-position: center;
background-size:cover;
}
label{

	font-weight:bold;
}


</style>
	</head>

	<body>
		
	
		<!-- Header ends -->

		<!-- Container fluid Starts -->
		<div class="container-fluid">

			<!-- Navbar starts -->
			<nav class="navbar navbar-default">
			<div class="navbar-header">
					<span class="navbar-text">Menu</span>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-navbar" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>


				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="collapse-navbar">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="home.php"><i class="icon-blur_on"></i>Dashboard </a>
						</li>
						

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-terrain"></i>Tenant data <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li>
									<a href='add_tenant.php'>Add Tenant</a>
								</li>
								<li>
									<a href='list_tenants.php'>List Tenants</a>
								</li>
								<!--
								<li>
									<a href='list_payments.php'>List Payments</a>
								</li>
								<li>
									<a href='addlocation.php'>Add Location</a>
								</li>
                                <li>
									<a href='list_locations.php'>List Locations</a>
								</li>
								-->

								<li>
  										<a  href=<?php echo DOMAIN_URL."useraccount.php"; ?> >my account</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="logout.php"><i class="icon-widgets"></i>Logout</a>
						</li>
						
					</ul>
				</div>
			</nav>
			<!-- Navbar ends -->

			<!-- Dashboard wrapper starts -->
			<div class="dashboard-wrapper">

				<!-- Top bar starts -->
				<div class="top-bar clearfix">
					<div class="row gutter">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="page-title">
								<h4>Dashboard For <?php echo " ".$_SESSION['location']; ?></h4>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<!--<ul class="right-stats" id="mini-nav-right">
								<li>
									<a href="javascript:void(0)" class="btn btn-danger"><span>895</span>Sales</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="btn btn-success"><span>125</span>Leads</a>
								</li>
							</ul>-->
						</div>
					</div>
				</div>
				<!-- Top bar ends -->

				<!-- Main container starts -->
				<div id="d_wrapper" class="main-container">

					<!-- Row starts -->
					<div class="row gutter">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mini-widget">
								<div class="mini-widget-heading clearfix">
									<div class="pull-left">Tenants</div>
									<div class="pull-right"><i class="icon-arrow-up-right2"></i> </div>
								</div>
								<div class="mini-widget-body clearfix">
									<div class="pull-left">
										<i class="icon-globe"></i>
									</div>
									<div class="pull-right number"><?php echo $tnts; ?></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mini-widget green">
								<div class="mini-widget-heading clearfix">
									<div class="pull-left">Green flag</div>
									<div class="pull-right"><i class="icon-arrow-up-right2"></i> </div>
								</div>
								<div class="mini-widget-body clearfix">
									<div class="pull-left">
									<i class="icon-emoji-happy"></i>
									</div>
									<div class="pull-right number"><?php echo $greens; ?></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mini-widget yellow">
								<div class="mini-widget-heading clearfix">
									<div class="pull-left">Orange flag</div>
									<div class="pull-right"><i class="icon-arrow-down-right2"></i></div>
								</div>
								<div class="mini-widget-body clearfix">
									<div class="pull-left">
									<i class="icon-emoji-happy"></i>
									</div>
									<div class="pull-right number"><?php echo number_format($oranges); ?></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mini-widget blue">
								<div class="mini-widget-heading clearfix">
									<div class="pull-left">Blue flag</div>
									<div class="pull-right"><i class="icon-arrow-up-right2"></i> </div>
								</div>
								<div class="mini-widget-body clearfix">
									<div class="pull-left">
										<i class="icon-emoji-happy"></i>
									</div>
									<div class="pull-right number"><?php echo number_format($blues); ?></div>
								</div>
							</div>
						</div>
					</div>
					<!-- Row ends -->
					<div class="row gutter">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mini-widget red">
								<div class="mini-widget-heading clearfix">
									<div class="pull-left">Red flag</div>
									<div class="pull-right"><i class="icon-arrow-up-right2"></i> </div>
								</div>
								<div class="mini-widget-body clearfix">
									<div class="pull-left">
										
									</div>
									<div class="pull-right number"><?php echo number_format($reds); ?></div>
								</div>
							</div>
						</div>
</div>


				</div>
				<!-- Main container ends -->
			
			</div>
			<!-- Dashboard Wrapper End -->
		
		</div>
		<!-- Container fluid ends -->

		<!-- Footer Start -->
		<footer>
			© copyright <span><?php echo date('Y');?></span>
		</footer>
		<!-- Footer end -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.js"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>

		<!-- Sparkline Graphs -->
		<script src="js/sparkline/retina.js"></script>
		<script src="js/sparkline/custom-sparkline.js"></script>
		
		<!-- jquery ScrollUp JS -->
		<script src="js/scrollup/jquery.scrollUp.js"></script>

		<!-- D3 JS -->
		<script src="js/d3/d3.v3.min.js"></script>

		<!-- C3 Graphs -->
		<script src="js/c3/c3.js"></script>
		<script src="js/c3/c3.custom.js"></script>

		<!-- JVector Map -->
		<script src="js/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
		<script src="js/jvectormap/world-mill-en.js"></script>
		<script src="js/jvectormap/gdp-data.js"></script>
		<script src="js/jvectormap/world-map.js"></script>

		<!-- Circliful js -->
		<script src="js/circliful/circliful.min.js"></script>
		<script src="js/circliful/circliful.custom.js"></script>

		<!-- Peity JS -->
		<script src="js/peity/peity.min.js"></script>
		<script src="js/peity/custom-peity.js"></script>

		<!-- Custom JS -->
		<script src="js/custom.js"></script>		
	</body>
</html>