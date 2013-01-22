<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_projector = "ccsoc.cy8aybqmalrv.us-west-1.rds.amazonaws.com";
$database_projector = "projector";
$username_projector = "pearsonf";
$password_projector = "Poseidon";
$projector = mysql_pconnect($hostname_projector, $username_projector, $password_projector) or trigger_error(mysql_error(),E_USER_ERROR); 
?>