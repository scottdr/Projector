<!-- This php files generate the contents of the Lesson Navigator -->
<?php require_once('Connections/projector.php'); ?>
<?php require_once('Globals.php'); ?>
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

$SelectedStepNumber = 1;

$ProjectId = -1;
if (isset($_GET['Id'])) {
	$ProjectId = $_GET['Id'];
}

mysql_select_db($database_projector, $projector);
$query_routinesRecordset = sprintf("SELECT RoutineId, RoutineName, CSSName FROM RoutineAttach, Routines WHERE RoutineAttach.ProjectId = %s AND RoutineAttach.RoutineId = Routines.Id ORDER BY RoutineAttach.SortOrder",$ProjectId);
$routinesRecordset = mysql_query($query_routinesRecordset, $projector) or die(mysql_error());
$row_routinesRecordset = mysql_fetch_assoc($routinesRecordset);
$totalRows_routinesRecordset = mysql_num_rows($routinesRecordset);


?>
<div class="ribbon" id="pips">
<?php
if ($totalRows_routinesRecordset > 0) {
	$rowStepNumber = 1;
	do {
		if (isset($row_routinesRecordset)) {
			// this Query needs to be UPDATED for COMMON CORE projects look for the TaskId instead of RoutineId
			$query_stepsRecordset = sprintf("SELECT Steps.Id, Steps.Title,  Steps.Description, ProjectId, SortOrder, TemplateName, Name, RoutineId FROM Steps WHERE ProjectId = %s AND Steps.RoutineId = %s ORDER BY SortOrder",$ProjectId, $row_routinesRecordset['RoutineId']);
	//	print "query = $query_stepsRecordset\n<br />";
			$stepsRecordset = mysql_query($query_stepsRecordset, $projector) or die(mysql_error());
			$row_stepsRecordset = mysql_fetch_assoc($stepsRecordset);
			
			do {
				echo '<div class="ribbon-item" data-number="' . $rowStepNumber . '">' . "\n\t";
				echo '<p class="ribbon-item-number">' . $rowStepNumber . '</p>' . "\n\t";
				echo '<p class="ribbon-item-title">' . $row_stepsRecordset['Title'] . '</p>' . "\n\t";
				echo '<p class="ribbon-item-description">' . $row_stepsRecordset['Description'] . '</p>' . "\n\t";
        echo '<img class="ribbon-item-image" src="_images/placeholder_img.gif">' . "\n";
				echo '</div>' . "\n";
				$rowStepNumber++;			
			}  while ($row_stepsRecordset = mysql_fetch_assoc($stepsRecordset));
		}
	} while ($row_routinesRecordset = mysql_fetch_assoc($routinesRecordset));
}
?>
</div><!-- end of ribbon -->