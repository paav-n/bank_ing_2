<?php

include ("functions.php") ;
include ("account.php") ;
session_start();
session_set_cookie_params(0, "/~psn24/IT202/assignment_2/", "web.njit.edu");

$UCID= $_SESSION["UCID"];
$status= $_SESSION["Logged"];
$Delay = $_SESSION["Delay"];

if(!$status){
	echo"Not Logged In<br>"; 
	header("Refresh:$Delay; url=http://web.njit.edu/~psn24/IT202/assignment_2/login.html");
	die();
	}
	
$db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }

mysqli_select_db( $db, $project ); 

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);
	
$flag = false;
$account = GET("acc",$flag); 
$amount = GET("amount",$flag); 
$type = GET("type",$flag);
if($flag){exit("<br>Failed: empty input field");}

echo "UCID is: $UCID<br>";
echo "Account Number is: $account<br>";
echo "Amount is: $amount<br>";
echo "Type is: $type<br></br>";

?>

<a href="transaction.php">Transaction</a><br>
<a href="logout.php">Logout</a><br></br>
