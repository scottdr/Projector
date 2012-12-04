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
	$sqlQuery = sprintf("SELECT DISTINCT Routines.Id AS RoutineId, RoutineName, Steps.LessonName AS LessonName, Steps.Id AS StepId FROM Routines INNER JOIN RoutineAttach, Steps WHERE Steps.RoutineId = RoutineAttach.RoutineId AND Routines.Id = Steps.RoutineId AND Steps.ProjectId = %s ORDER BY RoutineAttach.SortOrder",$projectId);
} else {
	$sqlQuery = "SELECT DISTINCT Routines.Id AS RoutineId, RoutineName, Steps.LessonName, Steps.Id AS StepId FROM Routines INNER JOIN RoutineAttach, Steps WHERE Steps.RoutineId = RoutineAttach.RoutineId AND Routines.Id = Steps.RoutineId ORDER BY RoutineAttach.SortOrder";
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
	$step =  new StepInfo($row_Recordset1['LessonName'],$row_Recordset1['StepId']);
//	echo "Step Id " . $step->id . ", Name: ". $step->name . "<br />\n";
	$routineArray[$routineNumber-1]->steps[] = $step;
//	echo $row_Recordset1['RoutineId'] . ", " . $row_Recordset1['RoutineName'] . ", " . $row_Recordset1['LessonName'] . ", " . $row_Recordset1['StepId'] . "<br />\n";
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
}

for ($i=0;$i<count($routineArray);$i++) {
		$routineCSSId = "acc_routine" . $i . "_inner"; 
		$currentRoutine = $routineArray[$i];
		echo '<div class="accordion-heading">' . "\n";
    echo '<a class="accordion-toggle " data-toggle="collapse" data-parent="#acc_routines" href="#' . $routineCSSId . '">' . "\n";
			echo $routineArray[$i]->name . '(' . count($routineArray[$i]->steps) . ')'; 
    echo "</a>\n";
    echo "</div>\n";
	
		echo '<div id="' . $routineCSSId . '" class="accordion-body collapse">' . "\n";
		for ($j=0;$j<count($currentRoutine->steps);$j++) {
			echo '<div class="accordion-inner accordion-step">' . "\n";
      echo $j + 1 . ". ". $currentRoutine->steps[$j]->name . '<a class="btn btn-small btn-right btn-primary step" href="#"><i class="icon-pencil icon-white"></i> Edit step</a>' . "\n";
			echo "</div>\n";
		}
			echo '<div class="accordion-inner accordion-step">' . "\n";
    	echo '<a class="btn btn-small" href="#"><i class="icon-plus"></i> Add step</a>' . "\n";
   		echo '</div>' . "\n";
	 	echo "</div>\n";
}

?>
  </div>
</div>

<!--
<div class="accordion" id="acc_routines">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle " data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine1_inner">
        Routine one - Your challenge (2) 
      </a>
    </div>
    <div id="acc_routine1_inner" class="accordion-body collapse">
      <div class="accordion-inner accordion-step">
        1. Step one <a class="btn btn-small btn-right btn-primary step" href="#"><i class="icon-pencil icon-white"></i> Edit step</a></div>
      <div class="accordion-inner accordion-step">
        2. Step two <a class="btn btn-small btn-right btn-primary step" href="#"><i class="icon-pencil icon-white"></i> Edit step</a></div>
      <div class="accordion-inner accordion-step">
        <a class="btn btn-small" href="#"><i class="icon-plus"></i> Add step</a>
      </div>
    </div>
  </div>
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine2_inner">
        Routine two - Start (1)
      </a>
    </div>
    <div id="acc_routine2_inner" class="accordion-body collapse">
      <div class="accordion-inner accordion-step">
        1. Step one <a class="btn btn-small btn-right btn-primary step" href="#"><i class="icon-pencil icon-white"></i> Edit step</a></div>
      <div class="accordion-inner accordion-step">
        <a class="btn btn-small" href="#"><i class="icon-plus"></i> Add step</a>
      </div>
    </div>
  </div>
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine3_inner">
        Routine three - Plan (0)
      </a>
    </div>
    <div id="acc_routine3_inner" class="accordion-body collapse">
      <div class="accordion-inner accordion-step">
        <a class="btn btn-small" href="#"><i class="icon-plus"></i> Add step</a>
      </div>
    </div>
  </div>
</div>
-->
<?php
mysql_free_result($Recordset1);
?>
