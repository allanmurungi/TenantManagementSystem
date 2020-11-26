<?php 
session_start();
include("connection.php");
include("constants.php");
include("utilityfunctions.php");


if(!isset($_SESSION["email"]) ){

header("location:http://localhost:12345/site/userlogin.php");


}


$email=$_SESSION['email'];
//unset($_POST['edit']);
$ereply="";
if(isset($_POST['p_adm2'])){

try{
	
	$psd2=$_POST["password2"];
    
    $psd=crypt($_POST['password'], '$2b$08$' . randomString() . '$'); 

$data = array( 'psd' => $psd,
    'email' => $email,
);

echo $psd2."-";
echo $psd."-";
echo $email."-";


if(isset($_POST['p_web'])){

    $sqlp = "UPDATE users SET pswd=:psd  WHERE email=:email" ;

    $stmtp = $conn->prepare($sqlp);
       
           // execute the query
     $stmtp->execute($data);

}



Unset($_POST['p_adm2']);



}catch(Exception $e){

//echo "error: " . $e->getMessage();
$ereply="edit failed";

}

header("location: http://localhost:12345/site/useraccount.php");
}//end of if



?>

<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Nov 2016 16:04:07 GMT -->
<head>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo company; ?> | Member</title>

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap-3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<style>
body {
    background-image: url("http://localhost:12345/site/images/main.jpg");
    
    background-attachment: fixed;
    
    background-repeat: no-repeat;

    overflow-x:hidden;
   
   
   /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-size: cover;
}



/* Set a style for all buttons */
#submit {
    
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 75%;
}

#submit:hover {
    opacity: 0.8;
}


.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: left;
    padding-top: 16px;
}
.signup{
    width: 45%;
    margin: 10px;
    
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}


.card {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.gray {
    padding: 2px 16px;
}
.cardimg,#logo {
    border-radius: 5px 5px 0 0;
}
<!-- top nav-->


.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}


</style>


<script type='text/javascript'>
var imgerr="false";
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}


</script>


</head>

<body class="gray-bg">
  <div class="navbar-wrapper">
      <div class="container">
<!--new nav -->
<nav class="navbar navbar-inverse navbar-static-top">
<div class="topnav" id="myTopnav">

        <a class="nav-link"  href=<?php echo DOMAIN_URL."useraccount.php"; ?> >my account</a></li>    
        <a class="nav-link"  href=<?php echo DOMAIN_URL."logout.php"; ?> >logout</a></li>     

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">menu
    <i class="fa fa-bars"></i>
  </a>
</div>
     
    </nav>
      </div>
    </div>


    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6" align="center">
            <?php echo "<b>".$ereply."</b>"; ?>
            <p id=notice><p>
				 <div class="card">
 					 <img class="cardimg" src="images/main.jpg" alt="Avatar" style="width:100%">
					  <div class="gray">
					    <h4><b><?php echo company; ?></b></h4>
					    <p>cloud services</p>
					  </div>  
					
					 
				</div> 

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
      <form class="m-t" enctype="multipart/form-data" role="form" id="oForm" name="myForm" method="post" onsubmit="return validateForm()"  action=<?php echo $_SERVER['PHP_SELF']; ?> >
                                                
					
								 <div class="card" id="dvPreview" align="center">
 				
					 
								</div> 					

                        <br/>
                       

						<div class="form-group">
                            <input type="password" class="form-control"  placeholder="new password" required="" name="password">
                        </div>                          
							<div class="form-group">
                            <input type="password" class="form-control"  placeholder="re-enter password" required="" name="password2">
                        </div>    
						
						
						    
                      
							<input type="hidden" name="email" value=<?php  echo $email; ?> />
							<input type="hidden" name="p_adm2" value=<?php echo $email; ?> >
							<input type="hidden" name="p_web" value=<?php echo $email; ?> >

                        <button type="submit" name="submit" class="btn btn-primary block full-width m-b">edit password</button>

                       
                    </form>
                    <p class="m-t">
                        <small> <?php echo company; ?> &copy; <?php echo date('Y')?></small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        
    </div>
            
    <script type='text/javascript'>
/


function validateForm() {
    
    
    var x = document.forms["myForm"]["password"].value;    
    var y = document.forms["myForm"]["password2"].value;
    var notice=document.document.getElementById("notice");
    if (x != y) {
        
        notice.innerHTML="passwords don't match";
        alert("passwords don't match");

    return false;

    }
    
	

    return true;
} 


</script>



</body>


</html>
