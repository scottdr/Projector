<?php require_once('Connections/projector.php'); ?>
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

$colname_MediaQuery = "-1";
if (isset($_GET['ProjectId'])) {
  $colname_MediaQuery = $_GET['ProjectId'];
}
mysql_select_db($database_projector, $projector);
if ($colname_MediaQuery == -1)
	$query_MediaQuery = "SELECT * FROM Media";
else
	$query_MediaQuery = sprintf("SELECT * FROM Media WHERE ProjectId = %s", GetSQLValueString($colname_MediaQuery, "int"));
$MediaQuery = mysql_query($query_MediaQuery, $projector) or die(mysql_error());
$totalRows_MediaQuery = mysql_num_rows($MediaQuery);
$row_MediaQuery = mysql_fetch_assoc($MediaQuery);

session_start();
?>
<div style="text-align:center">
<table id="MediaTable" width="320	" class="clearFloat">
  <?php do { ?>
  <tr class="rowItem">
      <td width="120"><a href="AttachMedia.php?Id=<?php echo $row_MediaQuery['Id']; ?>&amp;ProjectId=<?php echo $_SESSION['ProjectId']; ?>&amp;StepId=<?php echo $_SESSION['StepId']; ?>"><img src="<?php echo $row_MediaQuery['Url']; ?>" alt="<?php echo $row_MediaQuery['Description']; ?>" name="" width="120" height="90" /></a></td>
      <td width="200" nowrap="nowrap"><div class="captionDiv"><a href="AttachMedia.php?Id=<?php echo $row_MediaQuery['Id']; ?>&amp;ProjectId=<?php echo $_SESSION['ProjectId']; ?>&amp;StepId=<?php echo $_SESSION['StepId']; ?>"><?php echo $row_MediaQuery['Caption']; ?></a></div></td>
    </tr>
   <?php } while ($row_MediaQuery = mysql_fetch_assoc($MediaQuery)); ?>
</table>
</div>
<?php

mysql_free_result($MediaQuery);
?>

