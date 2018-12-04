<?php

session_start();
session_set_cookie_params(0, "/~psn24/IT202/assignment_2/", "web.njit.edu");
$sidvalue= session_id(); echo "<br>Your session id  " . $sidvalue . "<br>";
$_SESSION=array();
session_destroy();
setcookie("PHPESSID","", time()-3600,'/~psn24/IT202/assignment_2/',"", 0,0);
echo "Your session is terminated";

?>


