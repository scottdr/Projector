<?php require_once('../Connections/projector.php'); ?>
<?php require_once('../Globals.php'); ?>
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
$query_routinesRecordset = sprintf("SELECT RoutineId, RoutineName, CSSName, Icon FROM RoutineAttach, Routines WHERE RoutineAttach.ProjectId = %s AND RoutineAttach.RoutineId = Routines.Id ORDER BY RoutineAttach.SortOrder",$ProjectId);
$routinesRecordset = mysql_query($query_routinesRecordset, $projector) or die(mysql_error());
$row_routinesRecordset = mysql_fetch_assoc($routinesRecordset);
$totalRows_routinesRecordset = mysql_num_rows($routinesRecordset);

$stepArray = array();
if ($totalRows_routinesRecordset > 0) {
	$rowStepNumber = 1;
	do {
		if (isset($row_routinesRecordset)) {
			// this Query needs to be UPDATED for COMMON CORE projects look for the TaskId instead of RoutineId
			$query_stepsRecordset = sprintf("SELECT Steps.Id, Steps.Title, ProjectId, SortOrder, TemplateName, Name, RoutineId FROM Steps WHERE ProjectId = %s AND Steps.RoutineId = %s ORDER BY SortOrder",$ProjectId, $row_routinesRecordset['RoutineId']);
	//	print "query = $query_stepsRecordset\n<br />";
			$stepsRecordset = mysql_query($query_stepsRecordset, $projector) or die(mysql_error());
			$row_stepsRecordset = mysql_fetch_assoc($stepsRecordset);
			
			do {
				$arr = array( 'RoutineID' => $row_routinesRecordset["RoutineId"], 'RoutineName' => $row_routinesRecordset["RoutineName"], 'RoutineIcon' => $row_routinesRecordset["Icon"],  "StepNumber" => $rowStepNumber, "StepId" => $row_stepsRecordset["Id"], 'StepTitle' => $row_stepsRecordset["Title"], 'StepName' => $row_stepsRecordset["Name"]);
				$stepArray[] = $arr;
				$rowStepNumber++;			
			}  while ($row_stepsRecordset = mysql_fetch_assoc($stepsRecordset));
		}
	} while ($row_routinesRecordset = mysql_fetch_assoc($routinesRecordset));
	echo json_encode($stepArray);
}
?>
