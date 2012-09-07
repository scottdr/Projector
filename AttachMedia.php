<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php require_once('Connections/projector.php'); 

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

?>
<?php
print "We are going to attach the media " . $_GET['Id'] . " to the step: " . $_GET['StepId'] . " with the Project ID: " . $_GET['ProjectId'];

mysql_select_db($database_projector, $projector);

$sqlCommand = sprintf("INSERT INTO MediaAttach SET MediaId = %s, ProjectId = %s, StepId = %s",
										 GetSQLValueString($_GET['Id'], "int"),
										 GetSQLValueString($_GET['ProjectId'], "int"),
										 GetSQLValueString($_GET['StepId'], "int"));
										 
$Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

$updateGoTo = "EditStep.php";
$updateGoTo .= "?Id=" . $_GET['StepId'];

header(sprintf("Location: %s", $updateGoTo));
?>
</body>
</html>