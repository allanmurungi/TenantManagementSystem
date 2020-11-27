<?php
session_start();
include("connection.php");
include("constants.php");
include("utilityfunctions.php");


date_default_timezone_set("Africa/Kampala");

$reply="";


if(isset($_POST['user'])){
    
    session_destroy();
    session_start();
    try{
        $email = $_POST["email"];  
        $uname=$_POST["uname"];   
    
        $pswd=crypt($_POST['password'], '$2b$08$' . randomString() . '$');

       
        $uname=str_replace(' ', '', $uname); 
        $uname=$uname.randomString(4);
    
    
    if(isset($_POST['web'])){
    
   
      
        $stmt = $conn->prepare("INSERT INTO users (email,uname,pswd)
        VALUES (:email,:uname,:pswd)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':uname', $uname);
        $stmt->bindParam(':pswd', $pswd);
        
        
        
    $stmt->execute();


   
           
    $_SESSION['visitor_logged_in']="yes";
    $_SESSION['visitor_email']=$email;
    $_SESSION["in_as"] = 'user';
    $_SESSION['email']=$email;
    $_SESSION['uname']=$uname;

    

    header("location: usersuccess.php");
    
           
           
        
    
    
    
    
    
    
    
}
    
    unset($_POST['user']);
    
    
    
    }catch(Exception $e){
    
    //echo "error: " . $e->getMessage();
     $reply="sorry there was an error uploading the information";
    }
    
    }//end of if
    





?>
<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Nov 2016 16:04:07 GMT -->
<head>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo Company; ?></title>

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
    background-image:  url("images/main.jpg");
    
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


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  overflow:auto;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100%;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
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

   function images(event){
       var id =event.target.name;
       event.target.width="150";
       event.target.height="150";
       var reply = confirm("Do you wish to remove this image?");
      if (reply==true){
       	var div=document.getElementById("dvPreview");
				div.innerHTML = "";
			var fileinput=document.getElementById("w");
				fileinput.value="";
       var element=document.getElementById(id);
       
       for(var i = 0; i < element.files.length; i++){
           var file=element.files[i];
       if(file.name==event.target.class){       
		
             event.target.src="";
              event.target.hidden="true";
             event.target.width="150";
             event.target.height="150";
	   				 var form = document.getElementById("form");
					  var input = document.createElement("input");
					  input.type="hidden";
					  input.value=file.name;
					  input.name=file.name;
	   				form.appendChild(input);
                                                                
	   }//end of if
	   
  }//loop

      

}
else{
        event.target.width="150";
       event.target.height="150";

}
}  

window.onload = function () {
 var fileuploadw = document.getElementById("w");
    fileuploadw.onchange = function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("dvPreview");
            dvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileuploadw.files.length; i++) {
                var file = fileuploadw.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        img.name="w";
                        img.addEventListener("click", images, false);
                        img.class=file.name;                        
						img.id="logo";
                        img.height = "150";
                        img.width = "150";
                        img.src = e.target.result;
                        dvPreview.appendChild(img);                        
				
						var divimage=document.createElement("div");
							divimage.innerHTML = "your memember photo";
							divimage.class="gray";
						dvPreview.appendChild(divimage);      

                    }
                    reader.readAsDataURL(file);
                } else {
                    alert(file.name + " is not a valid image file.");
                    dvPreview.innerHTML = "";
                    imgerr="true";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }//
}
</script>


</head>

<body class="gray-bg">
  <div class="navbar-wrapper">
      <div class="container">
<!--new nav -->
<nav class="navbar navbar-inverse navbar-static-top">
<div class="topnav" id="myTopnav">
    <a  href=<?php echo DOMAIN_URL."userlogin.php"; ?>><?php echo "login"; ?></a>
    <a  href=<?php echo DOMAIN_URL."userregister.php"; ?>><?php echo "register"; ?></a>
     
   
  

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
               
				 <div class="card">
				     <p><?php echo $reply; ?></p>
 					 <img class="cardimg" src="images/main.jpg" alt="Avatar" style="width:100%">
					  <div class="gray">
					    <h4><b>company corp.</b></h4>
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
                            <input type="text" class="form-control"  placeholder="email" required="" name="email">
                        </div>  
                        
                        <div class="form-group">
                            <input type="text" class="form-control" pattern="[A-Za-z0-9]+" maxlength="10" placeholder="user name" required="" name="uname">
                        </div>      
						
						<div class="form-group">
                            <input type="password" class="form-control"  placeholder="password" required="" name="password">
                        </div>                          
							<div class="form-group">
                            <input type="password" class="form-control"  placeholder="re-enter password" required="" name="password2">
                        </div>    
	    
                        
                        <input type="hidden" name="user" value="user">
							<input type="hidden" name="web" value="web" >
							

                        <button type="submit" name="submit" class="btn btn-primary block full-width m-b">sign up</button>

                       
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

function validateForm() {
    
    return true;
} 


window.onclick = function(event) {
        
}
</script>



</body>


</html>
