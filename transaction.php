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

print "<pre>This is $UCID transaction.php</pre>";

?>
<a href="display.php">Display</a><br></br>
<a href="logout.php">Logout</a><br></br>
<form action="w-or-d-stub.php">

	Pick Account<br>
	<?php include("radio-buttons.php"); ?><br>
	<input type=hidden name='UCID' value = '<?php echo $UCID;?>'>  
	Enter Amount <input type="number" name="amount" placeholder="required" autocomplete="off" step=".01" required/><br></br>
    D or W <select name = "type" required>
		<option value="" disabled selected>Choose One</option>
		<option value = 'D'>deposit</option>
		<option value = 'W'>withdraw</option>
	</select><br></br>
    <input type=submit value="Submit">
	<span id="showTime"></span>
	<input type=checkbox checked id= "check" > Time-Out
</form>

<script>
"use strict"
document.addEventListener("click", reset)
document.addEventListener("keyup", reset)
var seconds = 4;
var timer;
var check= document.getElementById("check");

var showTime= document.getElementById( "showTime");


function countdown(){
	if(check.checked) {
		showTime.innerHTML="";
		return; 
	};
  showTime.innerHTML="<h1>seconds is: " +seconds+ "</h1>";
  seconds = seconds - 1;
};

setInterval(countdown, 1000);

function reset() {
	if(check.checked) {
		return; 
	};
	seconds = 4;
	clearTimeout(timer);
	timer= setTimeout(logout,4000);
}
function logout() {
	if(check.checked) {
		return; 
	};
	window.location.href="logout.php"
}
</script>
