<?php 
session_start();
include("connection.php");
include("constants.php");
include("utilityfunctions.php");


date_default_timezone_set("Africa/Kampala");

if(!isset($_SESSION["email"]) ){

    header("location: ".DOMAIN_LOGIN);
    
    
    }

  

    $email=$_SESSION['email'];
    $uname=$_SESSION['uname'];  


    try{

      $stmtx = $conn->prepare("SELECT location FROM locations", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
      
      $rowx = $stmtx->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
      $stmtx->execute();  
      
      $categories=array();
      
      while ($rowx = $stmtx->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)){ 
      
      array_push($categories,$rowx[0]);
      
      }//end of while
      }
      catch(PDOException $e)
      {
      //echo "<br/>"."query failed: " ;
      //echo "". $e->getMessage();
      }



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
img{
width:200px;
height:200px;

}


</style>


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
<div class="row col-md-12" align="center" >

<div class="col-md-12" align="center"  >
                <h2><span><img src="images/favicon.ico"></img></span></h2>
                <?php 
                 if(isset($_SESSION['del_response'])){ 
                     echo "<h4><b>process failed, please try again.<b><h4>";               
                ?>
          <?php } ?>
         
                <!--   profile div      -->

    
                        
    <div class="card">
                   
                    <div>
                       <h3>Landlord:   <span><b><?php echo Company; ?></b></span></h3>
                    </div>
                    <div>
                       <h3>email:   <span><b><?php echo $email; ?></b></span></h3>
                    </div>
                    <div>
                       <h3>username:    <span><b><?php echo $uname; ?></b></span></h3>
                    </div>
                    <div class="gray">

             
              <hr/>
    <form action="dashboard/home.php"   method="post">
        <input type="hidden" name="email" value="email" />
        <h3><b>please select default location:<b><h3>
        <select  input type ="text"  name="location" class="custom-select input-lg" id="sel1">
    
    <?php   for($i=0;$i<sizeof($categories);$i++){   ?>
    
    
    
    <?php if($i == 0){ ?>

    <?}else{?>
    
    <option value="<?php echo $categories[$i]; ?>" <?php echo "selected"; ?> ><?php echo $categories[$i];  ?></option>
    
    <?php } ?>
   
   
    <option value="<?php echo $categories[$i]; ?>" ><?php echo $categories[$i];  ?></option>
    
    
    <?php } ?>
    
    
      </select>
<br/>
<hr/>
        <button style="width:100%" type="submit" class="btn btn-primary block width="200" m-b">My Dashboard 
        </button>   
    </form>
           </hr>
  <hr/>
              <a href="dashboard/addlocation.php" style="width:100%" class="btn btn-primary block width="200" m-b" >Add New Location</a>
              <hr/>
              <a href="dashboard/list_locations.php" style="width:100%" class="btn btn-primary block width="200" m-b" >List Locations</a>
              <hr/>
              <a href="dashboard/list_payments.php" style="width:100%" class="btn btn-primary block width="200" m-b" >list payments</a>
              <hr/>

           <hr/>
    <form action="useredit.php"   method="post">
        <input type="hidden" name="email" value="email" />
        <input type="hidden" name="u_edit" value="u_edit" />
        <button style="width:100%" type="submit" class="btn btn-primary block width="200" m-b">edit profile 
                   </button>   
    </form>
               </hr>
               <hr/>
    <form action="userchangepassword.php"  method="post">
        <input type="hidden" name="email" value="email" />
        <button style="width:100%" type="submit" class="btn btn-primary block width="200" m-b">change password 
        </button>   
    </form>
           </hr>
           <hr/>
    <form action="deleteaccount.php"   method="post">
        <input type="hidden" name="email" value="email" />
        <button style="width:100%" type="submit" class="btn btn-primary block width="200" m-b">delete account 
       </button>   
    </form>
    
                    <h4><b><?php echo company; ?></b></h4>
                      <p>cloud services</p>
                    </div>  
    </div> 
    <!-- side rows  -->
               <hr/>

   


</div>
         
          




        </div>
     
        
    </div>
     
      

      
      
      
      
      
      

</body>


</html>
