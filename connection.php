<?php
$dbName="maindatabase";
$user="root";
$pwd="";
$host="localhost";

try{
$conn=new PDO('mysql:host=localhost;dbname=maindatabase',$user,$pwd);

 // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "coonection succesful";

}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

 

?>