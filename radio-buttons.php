<?php

$s="select * from AA where UCID='$UCID'";
($t = mysqli_query($db, $s)) or die (mysqli_error($db));
while($row = mysqli_fetch_array ($t, MYSQLI_ASSOC)){
	$line="";
	$account   = $row["account"]; 
	$current  = $row["current"];
	$line.="Current: $current Account #: $account  <input type=radio id=\"acc\" name = \"acc\" value=\"$account\" ><br>";
	echo $line;
};

?>