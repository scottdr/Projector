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

mysql_select_db($database_projector, $projector);
$query_RoutineList = "SELECT * FROM Routines";
$RoutineList = mysql_query($query_RoutineList, $projector) or die(mysql_error());
$row_RoutineList = mysql_fetch_assoc($RoutineList);
$totalRows_RoutineList = mysql_num_rows($RoutineList);mysql_select_db($database_projector, $projector);
$query_RoutineList = "SELECT * FROM Routines ORDER BY Id ASC";
$RoutineList = mysql_query($query_RoutineList, $projector) or die(mysql_error());
$row_RoutineList = mysql_fetch_assoc($RoutineList);
$totalRows_RoutineList = mysql_num_rows($RoutineList);
?>
<select name="RoutineId" id="RoutineId" value="<?php echo $row_steps['RoutineId']; ?>">
	<?php do { ?>
    <option value="<?php echo $row_RoutineList['Id']; ?>" <?php if ($row_RoutineList['Id'] == $row_steps['RoutineId']) echo ' selected="selected" '; ?>><?php echo $row_RoutineList['RoutineName']; ?></option>
  <?php } while ($row_RoutineList = mysql_fetch_assoc($RoutineList)); ?>
</select>
<?php
mysql_free_result($RoutineList);
?>
