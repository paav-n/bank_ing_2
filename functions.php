<?php
function GET( $fieldname, &$flag )//---------------------------------------------------------------------------------------------------------
{
	global $db;
	$fie = trim( $_GET [$fieldname] );
	if ($fie == "") { $flag = true ; echo "<br><br>$fieldname is empty." ; return  ;} ;
	$fie = mysqli_real_escape_string ($db, $fie );
	return $fie; 
}
function auth( $ucid, $pass, $db )//--------------------------------------------------------------------------------------------------------------------------------
{
	global $t;
	$a   =  "select * from AA where UCID = '$ucid'" ;
    //print "<br><br>SQL select statement is: $a<br>"; 

	($t = mysqli_query ( $db,  $a ) )  or die ( mysqli_error ($db) );
	
	$rows = $t->num_rows;
	print "<br>Recieved $rows rows.<br>";
	
	$row = mysqli_fetch_array ($t, MYSQLI_ASSOC);
	$hashedDB=$row["pass"];
	if($rows == 0) {
		return false;
		echo "<br>no rows<br>";
	} 
	echo "<br>$hashedDB<br>";
	if(password_verify($pass,$hashedDB)) {
		echo "<br>True<br>";
		return true; 
	}
	else {
		return false;
		echo "<br>False<br>";
		echo "<br>no match<br>";
	}	
}
function display ($ucid, $db, $account, &$output)//-----------------------------------------------------------------------------------------------------------------------------------------
{ 
  global $t;
  
  $output = "";
  $s ="select * from TT where ucid = '$ucid' and account = '$account'";
  $output .= "<br>SQL select statement is: $s<br>"; 
  ($t = mysqli_query ( $db,  $s   ) )  or die ( mysqli_error ($db) );
  
  $output .= "<table border=2  width = 30% >" ;
  $output.= "<style>tr:nth-child(even) {background-color: #00FFFF;}</style>" ;
	  while ( $r = mysqli_fetch_array ( $t, MYSQL_ASSOC) ) 
	  {
		$ucid = $r[ "UCID" ] ;
		$type = $r[ "type" ] ;
		$amount = $r[ "amount" ] ;
		$date = $r[ "date" ] ;
		$mail = $r[ "mail" ] ;
		$output .= "<tr>" ;
		$output .= "<td>$ucid</td>" ; 
		$output .= "<td>$type</td>" ;
		$output .= "<td>$amount</td>"; 
		$output .= "<td>$date</td>";
		$output .= "<td>$mail</td>";  
		$output .= "</tr>" ;
	  };
    $output .= "</table>";
	$s ="select * from AA where ucid = '$ucid' and account = '$account'";
	$output .= "<br>SQL select statement is: $s<br>"; 
	($t = mysqli_query ( $db,  $s   ) )  or die ( mysqli_error ($db) );
	
	$output .= "<table border=2  width = 30% >" ;
	  while ( $r = mysqli_fetch_array ( $t, MYSQL_ASSOC) ) 
	  {
		$ucid = $r[ "UCID" ] ;
		$pass = $r[ "pass" ] ;
		$name = $r[ "name" ] ;
		$mail = $r[ "mail" ] ;
		$initial = $r[ "initial" ] ;
		$current = $r[ "current" ] ;
		$recent = $r[ "recent" ] ;
		$plaintext = $r[ "plaintext" ] ;
		$output .= "<tr>" ;
		$output .= "<td>$ucid</td>" ; 
		$output .= "<td>$pass</td>" ;
		$output .= "<td>$name</td>"; 
		$output .= "<td>$mail</td>";
		$output .= "<td>$initial</td>";  
		$output .= "<td>$current</td>";  
		$output .= "<td>$recent</td>";  
		$output .= "<td>$plaintext</td>";  
		$output .= "</tr>" ;
	  };
	  $output .= "</table>";
}