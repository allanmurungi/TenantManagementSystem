<?php 
session_start();
include("connection.php");
include("constants.php");
include("utilityfunctions.php");


date_default_timezone_set("Africa/Kampala");

if(!isset($_SESSION["email"]) ){

header("location: ".DOMAIN_LOGIN);


}


$email=$_POST['email'];

$ereply="";


if(isset($_POST['u_adm2'])){

   
    
try{
	$email = $_POST["email"];   
    
    $oemail = $_POST["oemail"];   
    $oname=$_POST["oname"];
    

    
   
    $ps = "true";
    if ($ps == "true") {
      
       


$data = array( 
    'email' => $email,
    'oname' => $oname,
    
);




if(isset($_POST['web'])){

   
       

      
       if($oemail!=$email ){

        //echo "here3";
        $sqlp = "UPDATE users SET email=:email  WHERE uname=:oname" ;

       $stmtp = $conn->prepare($sqlp);
  
      // execute the query
        $stmtp->execute($data);

    
        $_SESSION['email']=$email;
    }






    $_SESSION['visitor_logged_in']="yes";
    $_SESSION['visitor_email']=$email;
    $_SESSION["in_as"] = 'user';
    
    if($oemail!=$email ){
    $_SESSION['email']=$email;
   
    
    }
   
   
}





    }else{


        $ereply = "Sorry, passwords do not match.";


    }

    Unset($_POST['uadm2']);
unset($_FILES);
}catch(Exception $e){

echo "error: " . $e->getMessage();
$ereply = "edit failed";

}

}//end of if

Unset($_POST['u_adm2']);




if(isset($_POST['u_edit'])){


    try{
    
    
    $themail=$_SESSION["email"];
    
    
    
   // echo $themail;
    $stmt = $conn->prepare("SELECT email,uname FROM users where email='$themail'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
      
    $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
    $stmt->execute();
    $mems=array();
       while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))  {
      //    	$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";      
            
            $mems=array("email"=>$row[0],"uname"=>$row[1]);
            //$mems=$row;
      
    
        } 
        $stmt = null;
    
    
    }
    catch(PDOException $e)
    {
    
    //echo "<br/>"."Connection failed: " . $e->getMessage();
    }
    
    $conn = null;
    
    
    
    
    }
    
    

    unset($_POST['u_edit']);




?>

<!DOCTYPE html>
<html>



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
    background-image: url("images/main.jpg");
    
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
var eimg = document.getElementById("e");
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
						eimg.hidden="true";
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
                            <input type="text" class="form-control" placeholder="email" required="" value=<?php echo $mems['email']; ?> name="email" required="" >
                        </div>                        

                        <div class="form-group">
                            <input type="hidden" class="form-control" pattern="[A-Za-z0-9]+" placeholder="uname" value=<?php echo $mems['uname']; ?>  name="uname"  >
                        </div> 
                        <div class="form-group">
                            <input type="hidden" class="form-control"  placeholder="password" name="password" value="x">
                        </div>
						
						
		        
							
							<input type="hidden" name="u_adm2" value="u_adm2" >
                            <input type="hidden" name="u_edit" value="u_edit" >
                            <input type="hidden" name="web" value="web" >
                            
                            <input type="hidden" name="oemail" value=<?php echo $mems['email']; ?> >
							<input type="hidden" name="oname" value=<?php echo $mems['uname']; ?> >

                        <button type="submit" name="submit" class="btn btn-primary block full-width m-b">edit email</button>

                       
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

</script>



</body>


</html>
