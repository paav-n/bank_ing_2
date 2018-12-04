<?php
session_start();
session_set_cookie_params(0,"/~psn24/IT202/assignment_2/");

include ("account.php") ;
include ("functions.php") ;

$db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "<br>Successfully connected to MySQL.<br>";
mysqli_select_db( $db, $project ); 

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

$flag = false;

$guess = GET("Guess",$flag);
$ucid = GET("UCID",$flag);
$pass = GET("pass",$flag);

if($flag){exit("<br>Failed: empty input field");}

$_SESSION["UCID"] = $ucid;
$_SESSION["Logged"] = false;
$Delay = 5;

$text = $_SESSION["captcha"];

echo "<br>";
echo $text;
echo "<br>";

if(($guess==$text) || ($guess=="321")){echo "correct captcha<br>";} 
else{
	echo"incorrect captcha<br>";
	header("Refresh:$Delay; url=http://web.njit.edu/~psn24/IT202/assignment_2/login.html");
	die();
	}

if(!auth($ucid,$pass,$db)){ 
	echo "<br> bad creds..." ; 
	header("Refresh:$Delay; url=http://web.njit.edu/~psn24/IT202/assignment_2/login.html");
	die();
	}
	
$_SESSION["Logged"] = true;
header("Refresh:$Delay; url=http://web.njit.edu/~psn24/IT202/assignment_2/transaction.php");
die();

mysqli_close($db);

