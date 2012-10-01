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
//print "We are going to attach the media " . $_GET['Id'] . " to the step: " . $_GET['StepId'] . " with the Project ID: " . $_GET['ProjectId'];

mysql_select_db($database_projector, $projector);

$sqlCommand = sprintf("INSERT INTO SlideAttach SET SlideId = %s, MediaId = %s",
										 GetSQLValueString($_GET['SlideId'], "int"),
										 GetSQLValueString($_GET['MediaId'], "int"));
										 
//print "sql: $sqlCommand\n";
$Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

$updateGoTo = "EditSlide.php";
$updateGoTo .= "?Id=" . $_GET['SlideId'];

header(sprintf("Location: %s", $updateGoTo));
?>
