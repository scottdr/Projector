<?php require_once('../../Connections/projector.php'); ?>
<?php
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

if ((isset($_GET['Id'])) && ($_GET['Id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM Media WHERE Id=%s",
                       GetSQLValueString($_GET['Id'], "int"));

  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($deleteSQL, $projector) or die(mysql_error());

  $deleteGoTo = "../Projector_ViewMedia.php";
  if (isset($_GET['ProjectId'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= "Id=" . $_GET['ProjectId'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}


mysql_free_result($Recordset1);
?>
