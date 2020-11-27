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

$table_name=$_SESSION['location'];



//test if post
if(isset($_POST['edit'])){

    $loc = $_POST['loc'];
	$loc1 = $_POST['loc1'];
	$id = $_POST['id'];
	

	

	
try {
 
$data= array('loc'=>$loc,
            
            'id'=>$id
);



$sql =" UPDATE locations SET location=:loc  WHERE id=:id";

			$stmt3 = $conn->prepare($sql);
		
		   
		    $stmt3->execute($data);

            $sql2 = "RENAME TABLE ".$loc1." TO ". $loc ;

            $stmt4 = $conn->prepare($sql2);

    $response =  "location Edited Successfully";
    
	
   //header("location:list_tenants.php");
    
}catch(PDOException $e){
    
   // $response = "<br/>"."query failed: " . $e->getMessage();
   $response = "failed to update"; 
    
    
}//end of try/catch


   
}//end of edit


if(isset($_POST['locedit'])){
    
    $id=$_POST['id'];
   
    
//get the products
$sql_prods = "SELECT * FROM locations where id='$id' ";
$result_prods= mysqli_query($conn2, $sql_prods);
$row2 = mysqli_fetch_array($result_prods);

}////end of getting edit material



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
							<a href=<?php echo DOMAIN_URL."useraccount.php"; ?>><i class="icon-blur_on"></i>my account </a>
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
							<a href="<?php echo DOMAIN_LOGOUT; ?>"><i class="icon-widgets"></i>Logout</a>
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
								<h4>Edit</h4>
							</div>
						</div>
					</div>
				</div>
				<!-- Top bar ends -->

							<!-- Row starts -->
					<div class="row gutter">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div id="d_wrapper" class="panel">
								<div class="panel-heading">
									<h4>Location update</h4>
									<?php if(isset($_POST['edit'])){?>
                          <div class="alert alert-info" role="alert"><?php echo $response; ?></div>
						  <?php
						unset($_POST['edit']);
						} ?>
						<hr/>
								</div>
								<div class="panel-body">
									<form id="movieForm" method="post" action=""  enctype="multipart/form-data">
									<div class="col-md-6">
											
<br>
										<div class="row gutter">
													<label class="control-label">Location</label>
													<input type="text" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="Location Name" class="form-control" value="<?php echo $row2['location']; ?>" name="loc" required />
												
											</div>
<br/>
										
						
								
<br>
							
										</div>

					<div class="col-md-6">
		
 
 
 
					<input type="hidden" name="locedit" value="locedit" />
											
											<input type="hidden" name="id" value=<?php  echo $_POST["id"]; ?> />
											
											<input type="hidden" name="loc1" value="<?php echo $row2['location']; ?>" />


											<div class="form-group">
										<button type="submit" class="btn btn-info" name="edit">Submit</button>
									</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- Row ends -->
					
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