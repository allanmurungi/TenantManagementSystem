<?php
$dbName="maindatabase";
$user="root";
$pwd="";
$host="localhost"; 

function getsubdate($date){
$color="none";
$enddate=$date;
$today = strtotime("today");

try{


//if(date("Y-m-d",$today)>=date("Y-m-d",$enddate)){

  if(date("Y-m-d",$today)>=date("Y-m-d",$enddate)){

  //$difference = date("Y-m-d",$today)->diff( date("Y-m-d",$enddate) );
$newtoday = date("d-m-y", $today)."";
$newend = date("d-m-y", $enddate)."";
  $date1=date_create($newtoday);
  $date2=date_create($newend);

  //echo $date1;
  //echo $date2;
  $diff=date_diff($date1,$date2);

  

  $interval=$diff->format("%a");
//$interval=97;
    if($interval>=95){

      $color="red";

    }
    elseif($interval>75 && $interval<=95){

      $color="red";
      
    }
    elseif($interval>60 && $interval<=75){

      $color="purple";
      
    }
    elseif($interval>=55 && $interval<=65){

      $color="blue";
      
    }elseif($interval>30 && $interval<55){

      $color="orange";
      
    }
    elseif($interval>10 && $interval<=30){

      $color="gold";
    }
    elseif($interval<10){

      $color="yellow";
    }




}
else{

$color = "green";

}

return $color;

}catch(PDOException $e){

  return "error";

}

}//end of function

/////////////////////////////////////
////////////////////////////////////
///////////////////////////////////

function check_table($tab){

    mysql_connect($host,$user,$pwd);
    mysql_select_db($dbName);
    
    $val = mysql_query('select 1 from `'.$tab.'`');
    
    if($val !== FALSE)
    {
       return "true";
    }else{
       return "false";
    }
    }
    
 

/////////////////////////
/////////////////////////

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
//////////////////////
/////////////////////
function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}



function rrmdir($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir."/".$object) == "dir") 
             rrmdir($dir."/".$object); 
          else unlink   ($dir."/".$object);
        }
      }
      reset($objects);
      rmdir($dir);
    }
   }


?>