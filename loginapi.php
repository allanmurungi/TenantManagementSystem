<?php
include("connection.php");
include("constants.php");
include("utilityfunctions.php");


date_default_timezone_set("Africa/Kampala");

$un=$_POST['email'];
$ps=$_POST['pswd'];
$match="false";
$result=array();

try{


 $stmt = $conn->prepare("SELECT email,pswd,uname FROM users where email='$un' ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
   

//

$response=array();

$row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
 $stmt->execute();  

$sub;
 while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))  { 

   

if (crypt($ps, $row[1]) == $row[1]) {
   
   // echo crypt($ps, $row[1])."lll".$ps."lll".$row[1];

   $match="true";
            $response['email']=$row[0];
            $response['pswd']=crypt($ps, $row[1]);	
            $response['uname']=$row[2];
            $response['u_status']="success";
            $response['u_verified']="yes";
            
          
   
} else {
    
    $response['u_status']="fail";

   
           
    
   
}







}//end of while

if(isset($_POST['web'])){
    
    session_start();
    session_destroy();
    session_start();
    
if(isset($response['email']) && isset($response['pswd'])){

$_SESSION["email"] = $response['email'];

$_SESSION["uname"] = $response['uname'];

$_SESSION["u_verified"] = $response['u_verified'];

$_SESSION["in_as"] = 'user';


header("location: ".ACCOUNT);

}else  {
   
$_SESSION["u_status"]="fail";
$_SESSION['u_status1']="fail2";

header("location: ".DOMAIN_LOGIN);

}

    
}

//echo json_encode($response);

}//end of try

catch(PDOException $e)
{

if(isset($_POST['web'])){
session_start();
session_destroy();
session_start();
$_SESSION["u_status"]="fail";
$_SESSION['u_status1']="fail3";
header("location: ".DOMAIN_LOGIN);

}
//echo "<br/>"."query failed: " . $e->getMessage();
//echo json_encode(array("u_status"=>"fail"));

}


$conn = null;



?>

		