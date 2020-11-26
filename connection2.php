<?php
$conn2 = mysqli_connect("localhost","root","","maindatabase");



// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?> 