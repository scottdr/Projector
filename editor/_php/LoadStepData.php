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

$colname_StepData = "-1";
if (isset($_GET['StepId'])) {
  $colname_StepData = $_GET['StepId'];
}
mysql_select_db($database_projector, $projector);
$query_StepData = sprintf("SELECT * FROM Steps WHERE Id = %s", GetSQLValueString($colname_StepData, "int"));
$StepData = mysql_query($query_StepData, $projector) or die(mysql_error());
$row_StepData = mysql_fetch_assoc($StepData);
$totalRows_StepData = mysql_num_rows($StepData);

if ($totalRows_StepData > 0) {
	echo json_encode($row_StepData);
}

mysql_free_result($StepData);
?>
