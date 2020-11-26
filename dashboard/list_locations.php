<?php 
session_start();

include("../connection.php");
include("../constants.php");
include("../utilityfunctions.php");

include("../connection2.php");

if(!isset($_SESSION["email"]) ){

	header("location:http://localhost:12345/site/userlogin.php");
	
	
	}
$respo="";
//remove item
if(  isset($_POST['locremove']) ){
    
 
 
$check="true";
$id=$_POST['id'];
$table_name=$_POST['loc'];
$result=array();

try {
   
if($check=="true"){
$itemname="";
$number="";


    // sql to delete a record    
    $sql = "DELETE FROM locations WHERE id='$id'";

    // use exec() because no results are returned
    $conn->exec($sql);

    
    $sql2=$conn->prepare("DROP TABLE ".$table_name." ");

    $sql2->execute();

    $result['object']="success";
    $respo="deleted successfully";
//echo json_encode($result);
    }    
}
catch(PDOException $e)
    {
  echo $sql . "<br>" . $e->getMessage();    
$result['object']="failed";
 $respo="failed to delete item";
//echo json_encode($result);
    }

 
 
 
 
 
 
 
 
 
 
 unset($_POST['locremove']);
 
 ////end of remove   
}


try{
//get the tenants
$sql_prods = "SELECT id,location FROM locations order by id asc";
$result_prods= mysqli_query($conn2, $sql_prods);
}catch(Exception $e){
    
}
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="Admin" />
		<meta name="keywords" content="Admin, Dashboard" />
		<meta name="author" content="Srinu Basava" />
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

		<!-- Data Tables -->
		<link rel="stylesheet" href="css/datatables/dataTables.bs.min.css">
		<link rel="stylesheet" href="css/datatables/autoFill.bs.min.css">
		<link rel="stylesheet" href="css/datatables/fixedHeader.bs.css">

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
td{

	font-weight:bold;
}
body{

	font-weight:bold;

}

</style>
	</head>

	<body>
		
		

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
					
				
						<li>
							<a href=<?php echo DOMAIN_URL."useraccount.php"; ?> ><i class="icon-blur_on"></i>my account </a>
						
						</li>
						
					

						<li class="dropdown active">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-terrain"></i>manage data <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<!--
								<li>
									<a href='add_tenant.php'>Add Tenant</a>
								</li>
								<li>
									<a href='list_tenants.php'>List Tenants</a>
								</li>
								-->
								<li>
									<a href='list_payments.php'>List Payments</a>
								</li>
								<li>
									<a href='addlocation.php'>Add Location</a>
								</li>
                                <li>
									<a href='list_locations.php'>List Locations</a>
								</li>
								<!--
								<li>
										  <a  href=<?php 
										  //echo DOMAIN_URL."useraccount.php";
										   ?> 
										  >my account</a>
								</li>
								-->
							</ul>
						</li>
					
						<li>
							<a href="http://localhost:12345/site/logout.php"><i class="icon-widgets"></i>Logout</a>
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
								<h4>List Locations</h4>
							</div>
						</div>
					</div>
				</div>
				<!-- Top bar ends -->

							<!-- Row starts -->
					<div class="row gutter">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel">
								<div class="panel-heading">
									<h4>Registered Places  </h4>
									<hr/>
									<h3><? if(isset($respo)){ echo $respo."vjhvgh"; } ?><h3>
								</div>
								<div class="panel-body">
									<div id="d_wrapper" class="table-responsive">
									    
										<table id="basicExample" class="table table-striped table-condensed table-bordered no-margin">
											<thead>
											  <tr>	
											  <th>S/N</th>

										      <th>Location</th>
										     
											  <th>action</th>
											  </tr>
											</thead>
											<!--
											<tfoot>
											  <tr>
											  <th>S/N</th>

										      <th>Location</th>
										     
											  <th>action</th>
											  </tr>
											</tfoot>
											-->
											<tbody>
								<?php 
								try{
$x = 1;
								while($row = mysqli_fetch_array($result_prods)){?>
											  <tr>
								<td><?php echo $x++; ?></td>
								<td><?php echo $row[1]; ?></td>
								

							
								<td>
								    	 <form action="editlocation.php"   method="post">
				
				
						<input type="hidden" name="id" value=<?php  echo $row[0]; ?> />
							<input type="hidden" name="locedit" value="locedit" />
                            <input type="hidden" name="loc" value=<?php  echo $row[1]; ?> />
							
							
	            <button type="submit" class="btn btn-primary block width="200" m-b"> <?php 
				echo "update";
				?> 
				</button>   
				
				</form>
							<hr/>
							 <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validatedel()"  method="post">
				
				
						<input type="hidden" name="id" value=<?php  echo $row["id"]; ?> />
							<input type="hidden" name="locremove" value="locremove" />
                            <input type="hidden" name="loc" value=<?php  echo $row[1]; ?> />
							
							
	            <button type="submit" class="btn btn-primary block width="200" m-b"> <?php 
				echo "remove";
				?> 
				</button>   
				
				</form>	    
								    
								</td>
											  </tr>
											 <?php }
								}catch(Exception $e){
								    
								    
								}
											 
											 ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Row ends -->



				</div>
				<!-- Main container ends -->
			
			</div>
			<!-- Dashboard Wrapper End -->
		
		</div>
		<!-- Container fluid ends -->

		<!-- Footer Start -->
		<footer>
			© copyright <span>2018</span>
		</footer>
		 <script>
   
   function validatedel() {
       
       
    
var r = confirm("Are you sure you want to delete the item?");
if (r == true) {
    
    return true;
} else {
   return false;
}    
       
   }
   </script>
		<!-- Footer end -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.js"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		
		<!-- jquery ScrollUp JS -->
		<script src="js/scrollup/jquery.scrollUp.js"></script>

		<!-- Custom JS -->
		<script src="js/custom.js"></script>
		<!-- Data Tables -->
		<script src="js/datatables/dataTables.min.js"></script>
		<script src="js/datatables/dataTables.bootstrap.min.js"></script>
		<script src="js/datatables/autoFill.min.js"></script>
		<script src="js/datatables/autoFill.bootstrap.min.js"></script>
		<script src="js/datatables/fixedHeader.min.js"></script>
		<script src="js/datatables/custom-datatables.js"></script>


		
	</body>
</html>