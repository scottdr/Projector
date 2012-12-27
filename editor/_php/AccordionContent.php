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

mysql_select_db($database_projector, $projector);

if (isset($projectId)) {
//	echo "Project ID: $projectId\n<br />";
	$sqlQuery = sprintf("SELECT Routines.Id AS RoutineId, RoutineName, Steps.Name AS Name, Steps.Id AS StepId FROM Routines INNER JOIN RoutineAttach, Steps WHERE Steps.RoutineId = RoutineAttach.RoutineId AND Routines.Id = Steps.RoutineId AND Steps.ProjectId = %s AND RoutineAttach.ProjectId = %s ORDER BY RoutineAttach.SortOrder, Steps.SortOrder",$projectId, $projectId);
} else {
	$projectId = -1;
	$sqlQuery = "SELECT DISTINCT Routines.Id AS RoutineId, RoutineName, Steps.Name, Steps.Id AS StepId FROM Routines INNER JOIN RoutineAttach, Steps WHERE Steps.RoutineId = RoutineAttach.RoutineId AND Routines.Id = Steps.RoutineId ORDER BY RoutineAttach.SortOrder, Steps.SortOrder";
}
	
$Recordset1 = mysql_query($sqlQuery, $projector) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<div class="accordion" id="acc_routines">
  <div class="accordion-group">
<?php

class StepInfo {
	public $name, $id;
	
	function __construct($name,$id) {
       $this->id = $id;
       $this->name = $name;
	}
}

class RoutineInfo{
	public $name, $numberOfSteps, $id;
	public $steps = array();
	
	function __construct($name,$id) {
       $this->id = $id;
       $this->name = $name;
   }
}

$routineArray = array();

$routineId = -1;
$routineNumber = 0;
for ($i=0;$i<$totalRows_Recordset1;$i++) {
	if ($row_Recordset1['RoutineId'] != $routineId) {
/*		echo '<div class="accordion-heading">' . "\n";
    echo '<a class="accordion-toggle " data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine1_inner">' . "\n";
			echo $row_Recordset1['RoutineName'] . '(2)'; 
    echo "</a>\n";
    echo "</div>\n";
		*/
		$routineArray[$routineNumber] =  new RoutineInfo($row_Recordset1['RoutineName'],$row_Recordset1['RoutineId']);
//		echo "Routine # " . $routineArray[$routineNumber]->id . ", Name: ". $routineArray[$routineNumber]->name . "<br />\n";
		$routineNumber++;
		$routineId = $row_Recordset1['RoutineId'];
	}
	$step =  new StepInfo($row_Recordset1['Name'],$row_Recordset1['StepId']);
//	echo "Step Id " . $step->id . ", Name: ". $step->name . "<br />\n";
	$routineArray[$routineNumber-1]->steps[] = $step;
//	echo $row_Recordset1['RoutineId'] . ", " . $row_Recordset1['RoutineName'] . ", " . $row_Recordset1['Name'] . ", " . $row_Recordset1['StepId'] . "<br />\n";
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
}

for ($i=0;$i<count($routineArray);$i++) {
		$routineCSSId = "acc_routine" . $i . "_inner"; 
		$currentRoutine = $routineArray[$i];
		echo "\t\t" . '<div class="accordion-heading">' . "\n";
    echo "\t\t\t" .'<a class="accordion-toggle " data-toggle="collapse" data-parent="#acc_routines" href="#' . $routineCSSId . '">' . "\n";
			echo $routineArray[$i]->name . ' (' . count($routineArray[$i]->steps) . ')'; 
    echo "</a>\n";
    echo "\t\t</div>\n";
	
		echo "\t\t" . '<div id="' . $routineCSSId . '" class="accordion-body collapse">' . "\n";
		for ($j=0;$j<count($currentRoutine->steps);$j++) {
			echo "\t\t\t" . '<div class="accordion-inner accordion-step">' . "\n";
      echo "\t\t\t\t" . $j + 1 . ". ". $currentRoutine->steps[$j]->name . '<a class="btn btn-small btn-right btn-primary step" data-stepId="' . $currentRoutine->steps[$j]->id . '" onclick="loadStepData(' . $projectId . ',' . count($routineArray[$i]->steps) . ',' . $currentRoutine->steps[$j]->id . ')" ><i class="icon-pencil icon-white"></i> Edit step</a>' . "\n";
			echo "\t\t\t</div>\n";
		}
		echo "\t\t" . '<div class="accordion-inner accordion-step">' . "\n";
		echo "\t\t\t" . '<a class="btn btn-small step-add" onclick="addStep(' . $projectId . ',' . count($routineArray[$i]->steps) . ',' . $routineArray[$i]->id . ')"><i class="icon-plus"></i> Add step</a>' . "\n";
		echo "\t\t" . '</div>' . "\n";
	 	echo "\t</div>\n";
}

?>
  </div>
</div>
<?php
mysql_free_result($Recordset1);
?>
