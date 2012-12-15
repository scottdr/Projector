<?php require_once('../Connections/projector.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_GET['Id'])) {
  $colname_Recordset1 = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_Recordset1 = sprintf("DELETE FROM CF_Resources WHERE Id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $projector) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
mysql_free_result($Recordset1);

$deleteGoTo = "ResourcesViewAll.php";
if (isset($_SERVER['QUERY_STRING'])) {
	$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
	$deleteGoTo .= $_SERVER['QUERY_STRING'];
}
header(sprintf("Location: %s", $deleteGoTo));
?>
