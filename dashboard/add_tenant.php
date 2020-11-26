<?php 
session_start();
include("../connection.php");
include('../connection2.php');
include("../constants.php");
include("../utilityfunctions.php");




if(!isset($_SESSION["email"]) ){

	header("location:http://localhost:12345/site/userlogin.php");
	
	
	}


$table_name=$_SESSION['location'];

//test if post
if(isset($_POST['add_tnt'])){

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$oname = $_POST['oname'];
	$username = $_POST['uname'];
	$email = $_POST['email'];
	$rent = $_POST['rent'];
	$r_unit = $_POST['r_unit'];
	$currency = $_POST['currency'];


	$rn=$_POST['rn1'];
	$dy=$_POST['dy1'];
	$mn=$_POST['month1'];
	$yr=$_POST['yr1'];
	
	$orn = $dy." ".$mn." ".$yr;
	$orn=strtotime( $orn );
	$datestring = "+".$rn." weeks";
	$renew_date = strtotime($datestring, $orn);


	$l_datestring = "+"."0"." weeks";
	$last_payment_date=strtotime($l_datestring, $orn);;
	


	//$renew_date = strtotime("today");
	
	
	$ilogo=$fname.$lname.randomNumber(6);
	

	

	
try {
  //sign up  
 $stmt = $conn->prepare("INSERT INTO ".$table_name." (fname,lname,other,username,email,logoname,rent,currency,renew_date,last_payment_date,r_unit)
    VALUES (:fname, :lname, :other,:username,:email,:logoname,:rent,:currency,:renew_date,:last_payment_date,:r_unit)");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':other', $oname); 
	$stmt->bindParam(':username', $username);   
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':logoname', $ilogo);
	$stmt->bindParam(':rent', $rent);
	$stmt->bindParam(':currency', $currency);
	$stmt->bindParam(':renew_date', $renew_date);
	$stmt->bindParam(':last_payment_date', $last_payment_date);
	$stmt->bindParam(':r_unit', $r_unit);
	


$stmt->execute();

//get id

$sql_prods = "SELECT id FROM ".$table_name." where logoname='$ilogo'";
$result_prods= mysqli_query($conn2, $sql_prods);
$row2 = mysqli_fetch_array($result_prods);

$id= $row2['id'];
//first payment
$stmt = $conn->prepare("INSERT INTO payments (last_payment_date,tnt_id,fname,lname,email)
    VALUES (:last_payment_date,:tnt_id,:fname,:lname,:email)");
    $stmt->bindParam(':last_payment_date', $last_payment_date);
	$stmt->bindParam(':tnt_id', $id);
	$stmt->bindParam(':fname', $fname);
	$stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':email', $email);
$stmt->execute();



    $response =  "Tenant Created Successfully";
    

   
    
}catch(PDOException $e){
    
  //  $response = "<br/>"."query failed: " . $e->getMessage();
    $response = "failed to update"; 
    
    
}//end of try/catch






}


$conn=null;
$conn2=null;
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

		<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->

		 <!-- Ignite UI Required Combined CSS Files -->
    <link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
    <link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/structure/infragistics.css" rel="stylesheet" />

    <script src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.8.3.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

    <!-- Ignite UI Required Combined JavaScript Files -->
    <script src="http://cdn-na.infragistics.com/igniteui/2017.2/latest/js/infragistics.core.js"></script>
    <script src="http://cdn-na.infragistics.com/igniteui/2017.2/latest/js/infragistics.lob.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/js/fileinput.js"></script>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/css/fileinput.css"/>

<style>
  .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
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
							<a href="home.php"><i class="icon-blur_on"></i>Dashboard </a>
						</li>
						
					

						<li class="dropdown active">
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
							<a href="http://localhost:12345/site/logout.php"><i class="icon-widgets"></i>Logout</a>
						</li>
						
					</ul>
				</div>
			</nav>
			<!-- Navbar ends -->

			<!-- Dashboard wrapper starts -->
			<div  class="dashboard-wrapper">

				<!-- Top bar starts -->
				<div class="top-bar clearfix">
					<div class="row gutter">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="page-title">
								<h4>Add Tenant To <?php echo " ".$_SESSION['location']; ?></h4>
							</div>
						</div>
					</div>
				</div>
				<!-- Top bar ends -->

							<!-- Row starts -->
					<div    class="row gutter">
						<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div id="d_wrapper" class="panel">
								<div class="panel-heading">
									<h4>Tenant</h4>
									
					<?php if(isset($_POST['add_tnt'])){?>
                          <div class="alert alert-info" role="alert"><?php echo $response; ?></div>
						  <?php
						 unset($_POST['add_tnt']);
						
						} ?>
								</div>
								<div  class="panel-body">
									<form id="movieForm" method="post" action=""  enctype="multipart/form-data">
									<div class="col-md-6">
										
										<div class="row gutter">
													<label class="control-label">Tenant First Name</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="first name" class="form-control" name="fname" required />
												
											</div>
											<br>
										<div class="row gutter">
													<label class="control-label">Tenant Last Name</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="last name" class="form-control" name="lname" required />
												
											</div>
											<br>
											<div class="row gutter">
													<label class="control-label">Tenant other Name</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="other name" class="form-control" name="oname" required />
												
											</div>
											<br>
											<div class="row gutter">
													<label class="control-label">Tenant user Name</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="user name" class="form-control" name="uname" required />
												
											</div>
											<br>
											<div class="row gutter">
													<label class="control-label">Tenant email</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="email" class="form-control" name="email" required />
												
											</div>
											<br>
											<div class="row gutter">
													<label class="control-label">Rental Unit</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="Rental Unit" class="form-control" name="r_unit" required />
												
											</div>
											<br>
										
<br>
											
										</div>

										<div class="col-md-6">

 
 
											<div class="row gutter">
													<label class="control-label">rent</label>
													<input type="text" pattern="[0-9]+" placeholder="rent" class="form-control" name="rent" required/>
											
											</div>
											<br>
												<div class="row gutter">
													<label class="control-label">Currency</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="Currency" class="form-control" name="currency" required/>
												</div>
												<br>
												
												<div class="row gutter">
													<label class="control-label">Enter number of weeks for Renewal of Stay:</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="number of weeks" class="form-control" name="rn1" required  />
												
											</div>
											<div class="row gutter">
											<hr/>
                                            <h4>Renew Tenant's Stay Starting On : </h4>
                                            <hr/>
													<label class="control-label">Start Day:</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="day" class="form-control" name="dy1" required  />
												
											</div>
											<br/>
											<div class="row gutter">
													<label class="control-label">Start month:</label>
											
													<select name="month1" id="months">
															<option value="january">january</option>
															<option value="february">february</option>
															<option value="march">march</option>
															<option value="april">april</option>
															<option value="may">may</option>
															<option value="june">june</option>
															<option value="july">july</option>
															<option value="august">august</option>
															<option value="september">september</option>
															<option value="october">october</option>
															<option value="november">november</option>
															<option value="december">december</option>
															</select>


											</div>
											<div class="row gutter">
													<label class="control-label">Start year:</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="year" class="form-control" name="yr1" required  />
												
											</div>
<br/>


											

											<div class="form-group">
										<button type="submit" class="btn btn-info" name="add_tnt">Submit</button>
									</div>
									</div>
									</form>
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
			© copyright <span>2020</span>
		</footer>
		<!-- Footer end -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.js"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		
		<!-- jquery ScrollUp JS -->
		<script src="js/scrollup/jquery.scrollUp.js"></script>

		<!-- Custom JS -->
		<script src="js/custom.js"></script>

    <script>
    
    
function validateForm() {
    
var imgerr="false";
 var fileuploadw = document.getElementById("files");
   
        if (typeof (FileReader) != "undefined") {
           
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            
            if(fileuploadw.files.length<1){

				return true;
			}
            
            for (var i = 0; i < fileuploadw.files.length; i++) {
                var file = fileuploadw.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    
                } else {
                    alert(file.name + " is not a valid image file.");
                  
                    imgerr="true";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
            return false;
        }
    return true;
} 

    
        $(function () {
            var buttonLabel = $.ig.Upload.locale.labelUploadButton;
            if (Modernizr.input.multiple) {
                buttonLabel = "Drag and Drop Files Here <br/> or Click to Select From a Dialog";
            }
            $("#igUpload1").igUpload({
                mode: 'multiple',
                multipleFiles: true,
                maxUploadedFiles: 5,
                maxSimultaneousFilesUploads: 2,
                progressUrl: "http://localhost/eshoper/products.php",
                controlId: "serverID1",
                controlName: "image",
                labelUploadButton: buttonLabel,
                onError: function (e, args) {
                    showAlert(args);
                }
            });
            if (Modernizr.input.multiple) {
                $(".ui-igstartupbrowsebutton").attr("style", "width: 320px; height: 50px;");
            }
        });

        function showAlert(args) {
            $("#error-message").html(args.errorMessage).stop(true, true).fadeIn(500).delay(3000).fadeOut(500);
        }
        
          function handleFileSelect(evt) {
              document.getElementById('list').innerHTML = '';
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);


    </script>


		
	</body>
</html>