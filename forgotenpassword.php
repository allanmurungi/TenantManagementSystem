<?php 
session_start();
include("connection.php");
include("constants.php");
include("utilityfunctions.php");


date_default_timezone_set("Africa/Kampala");

$reply="";
$status="un";

if(isset($_POST['cur_code'])){

    $cur_code=$_POST['cur_code'];

}else{

    $cur_code="";
}

if(isset($_POST["ent_un"])){

$uname = $_POST['uname'];
$type = $_POST['type'];
$_SESSION['type'] = $type;


if($type=="user"){
    
    try{
            $stmt = $conn->prepare("SELECT uname FROM users where uname='$uname' ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $response=array();
            $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            $stmt->execute();  
            while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))  { 
                    if(!empty($row[0])){
                   
                        $reply=$row[0];
                        $cur_code=randomNumber(6);
                        $status="code";
                   
                        $_SESSION['f_un'] = $uname;
                  //write code to file

                  $myfile = fopen("code.txt", "w") or die("Unable to open file!");
                  $txt =  $cur_code."\n";
                  fwrite($myfile, $txt);
                  fclose($myfile);

                    }else{
                        $reply="username does not exist";
                        $status="un";
                    }
        }
    }catch(Exception $e){

            $reply="Username does not exist";
            $status="un";
        }



}


}//end of if


if(isset($_POST['ent_code'])){

    if(isset($_SESSION['type'])){

        $type = $_SESSION['type'] ;
    
  
        
        if($type=="user"){
        
        
            if($_POST['code']==$cur_code){
                
                $status="renew";
                $reply="Great, the codes match";

            }else {

                $status="code";
                $reply="Sorry, the codes don't match";

            }
        
        }
        
    }else{

        $reply= "Error Occured";
    }


}//end of if
if(isset($_POST['renew'])){

    if(isset($_SESSION['type'])){

        $type = $_SESSION['type'] ;
    
  
        
        if($type=="user"){

            try{
            $un = $_SESSION['f_un'];
            $psd = $_POST['ps1'];
        
            $data = array( 'psd' => $psd,
            'un' => $un,
            );
            $psd=crypt($psd, '$2b$08$' . randomString() . '$');
            $sqlp = "UPDATE users SET pswd=:psd  WHERE uname=:un" ;
            $stmtp = $conn->prepare($sqlp);
            $stmtp->execute($data);
        
            $status="end";
            $reply="Great, successful";
        }catch(Exception $e){

            $status="renew";
            $reply="Failed, try again".$e->getMessage();

        }
        

        }
    }else{

        $reply= "Error Occured";
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



#maininput:focus {
    width: 100%;
}

#maininput2:focus {
    width: 100%;
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


.ddropdown {
  position: relative;
  display: inline-block;
}

.ddropdown-content {
  display: none;
  overflow:auto;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100%;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.ddropdown:hover .dropdown-content {
  display: block;
}






</style>


<script type='text/javascript'>


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
               <?php echo $status; ?>
				 <div class="card">
 					 <img class="cardimg" src="images/main.jpg" alt="Avatar" style="width:100%">
					  <div class="gray">
					    <h4><b><?php echo the_company ?></b></h4>
					    <p>cloud services</p>
					  </div>  
					
					 
				</div> 

            </div>
            <div class="col-md-6">
                <?php if($status=="un"){?>
                <div class="ibox-content">
                    <form class="m-t" role="form" name="myForm"   action=<?php echo DOMAIN_URL."forgotenpassword.php" ?> method="post">
                                                
								 <div class="card" id="dvPreview" align="center">
 					 			
								</div> 					

						<br/>

                        <div class="form-group">
                       
                        <input type="hidden" class="form-control"  value="user" required="" name="type">
                        </div>
						  
                        <div class="form-group">
                            <input type="text" class="form-control" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="username" required="" name="uname">
                        </div>   
						
						
							
                        <input type="hidden" name="ent_un" value="ent_un" > 

                        <button type="submit" name="submit" class="btn btn-primary block full-width m-b">send</button>

                       
                    </form>
                    <p class="m-t">
                        <small><?php echo the_company; ?> &copy; <?php echo date('Y')?></small>
                    </p>
                </div>
                <?php } ?>
            <!-- enter code sent to your mobile  -->
            <?php if($status=="code"){?>
            <div class="ibox-content">
                    <form class="m-t" role="form" name="myForm"   action=<?php echo DOMAIN_URL."forgotenpassword.php" ?> method="post">
                                                
								 <div class="card" id="dvPreview" align="center">
                                 <h4><b><?php echo $reply ?></b></h4>
								</div> 					

						<br/>
						  <div class="form-group">
                            <input type="text" class="form-control"  placeholder="enter code from file" required="" name="code">
                        </div>   
						
						
					
							 <input type="hidden" name="cur_code" value="<?php echo $cur_code; ?>" > 
                             <input type="hidden" name="ent_code" value="ent_code" > 

                        <button type="submit" name="submit" class="btn btn-primary block full-width m-b">send</button>

                       
                    </form>
                    <hr/>
                    <form class="m-t" role="form" name="myForm"   action=<?php echo DOMAIN_URL."forgotenpassword.php" ?> method="post">

                    <input type="hidden" name="uname" value="<?php echo  $_SESSION['f_un']; ?>" >
                    <input type="hidden" name="type" value="<?php echo $_SESSION['type']; ?>" >
                    <input type="hidden" name="ent_un" value="ent_un" > 
                        <button type="submit" name="submit" class="btn btn-primary block full-width m-b">resend code</button>
          
                                       </form>
                    <p class="m-t">
                        <small><?php echo the_company; ?> &copy; <?php echo date('Y')?></small>
                    </p>
                </div>



            <?php } ?>

            <!--  end of the div   -->

 <!-- renew password  -->
 <?php if($status=="renew"){?>
 <div class="ibox-content">
                    <form class="m-t" role="form" name="myForm" onsubmit="return validateForm()"  action=""  method="post">
                                                
								 <div class="card" id="dvPreview" align="center">
                                 <h4><b><?php echo $reply ?></b></h4>
								</div> 					

					
                        <div class="form-group">
                            <input type="password" class="form-control"  placeholder="password" required="" name="ps1">
                        </div>  
                        <div class="form-group">
                            <input type="password" class="form-control"  placeholder="re-enter password" required="" name="ps2">
                        </div>  
						
						
					
							 
                             <input type="hidden" name="renew" value="renew" > 

                        <button type="submit" name="submit" class="btn btn-primary block full-width m-b">send</button>

                       
                    </form>
                    <p class="m-t">
                        <small><?php echo the_company; ?> &copy; <?php echo date('Y')?></small>
                    </p>
                </div>


 <?php } ?>


            <!--  end of the div   -->



 <!-- renew end  -->
 <?php if($status=="end"){?>
 <div class="ibox-content">
                                <div class="card" id="dvPreview" align="center">
                                 <h4><b><?php echo $reply ?></b></h4>
								</div> 


                    <p class="m-t">
                        <small><?php echo the_company; ?> &copy; <?php echo date('Y')?></small>
                    </p>
                </div>


 <?php } ?>


            <!--  end of the div   -->






            </div>
        </div>
        <hr/>
        
    </div>
      
    
      
      
      
      
      
      
        
   <script>



function validateForm() {
    var x = document.forms["myForm"]["password"].value;    
	var y = document.forms["myForm"]["password2"].value;
    if (x == y) {
        
        return true;
    }else{    

	alert("passwords don't match");

		return false;
	}
} 


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    
	if(event.target == opt1){
	
		var search=document.getElementById('maininput');
			search.placeholder="enter street name";

	}
    	
}
</script>



</body>


</html>
