<?php require_once('../../Connections/projector.php'); ?>
<?php require_once('../../Globals.php'); ?>
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

if (isset($_GET['ProjectId']))
	$projectId = $_GET['ProjectId'];
if (isset($_GET['RoutineId']))
	$routineId = $_GET['RoutineId'];


if (isset($projectId) && isset($routineId)) {
	$sqlQuery = sprintf("SELECT Steps.Id, Steps.Name, Steps.RoutineId, Steps.SortOrder FROM Steps WHERE Steps.ProjectId = %s AND Steps.RoutineId = %s ORDER By SortOrder",$projectId,$routineId);
	
	mysql_select_db($database_projector, $projector);
	$Recordset = mysql_query($sqlQuery, $projector) or die(mysql_error());
	$row = mysql_fetch_assoc($Recordset);
	$recordCount = mysql_num_rows($Recordset);
	print "record # $recordCount\n";
} 


/*
SortOrder 	StepId	RoutineId
1 			10		1
2 			12		1
3 			13		1
4 			14		1
5 			15		1

Delete Step 3

SortOrder 	StepId	RoutineId
1 			10		1
2 			12		1
3 			14		1
4 			15		1


?action=delete&stepNumber=3&stepId=13&routineId=1

SELECT * FROM Steps Where Steps.RoutineId = 1 ORDER BY Steps.SortOrder

Delete the Item then
Just

*/
$commands = array();

function pushCommand($command) {
	global $commands;
	
	$commands[] = $command;
}

function pushUpdate($id,$newSortOrder) {
	$sqlCommand = sprintf("UPDATE Steps SET SortOrder=%s WHERE Id=%s",
                       GetSQLValueString($newSortOrder, "int"),
											 GetSQLValueString($id, "int"));
	echo "$sqlCommand\n<br />";
	pushCommand($sqlCommand);
}

function runCommands(){
	global $commands, $database_projector, $projector;
	echo "execute Command\n<br />";
	mysql_select_db($database_projector, $projector);
	while (count($commands)>0) {
		$sqlCommand = array_pop($commands);
		echo "$sqlCommand\n<br />";
		$Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());
	}
}


function resort() {
	global $recordCount, $row, $Recordset;
	for ($i=0;$i<$recordCount;$i++) {
		if ($row['SortOrder'] != $i+1) {
				$newSortOrder = $i+1;	
				pushUpdate($row['Id'],$newSortOrder);
		}
		$row = mysql_fetch_assoc($Recordset);
	}
	runCommands();
}

/*
Move 3rd Step to be 1st Step
?action=reorder&stepNumber=3&stepId=13&routineId=1&newOrder=1

SortOrder 	StepId	RoutineId
1 			10		1
2 			12		1
3 			13		1
4 			14		1
5 			15		1

AFTER:

SortOrder 	StepId	RoutineId
2			10		1
3 			12		1
1 			13		1				$newOrder = 1 < $stepNumber so we break here
4 			14		1
5 			15		1

Move 2nd Step to be after the 4th Step
?action=reorder&stepNumber=2 & stepId=12&routineId=1&newOrder=4

$stepNumber = 2
$newOrder = 4
$stepId = 12

SortOrder 	StepId	RoutineId
1 			10		1
4 			12		1
2 			13		1
3			14		1
5 			15		1
*/




function reorder($stepNumber,$stepId,$newOrder) {
	
	for ($i=0;$i<$recordCount;$i++) {
		if ($row['SortOrder'] >= $newOrder) {
			$newSortOrder = $row['SortOrder'] + 1;
			pushUpdate($row['Id'],$newSortOrder);
		} 	
		if ($row['Id'] == $stepId) {
			$newSortOrder = $newOrder;
			pushUpdate($row['Id'],$newSortOrder);
		if ($newOrder < $stepNumber) 	// if we are moving the item before where it was before we can stop when we reach it
				break;
		} else
		// we are moving beyond the existing item
		if ($row['SortOrder'] > $stepNumber && $newOrder > $stepNumber) {
			if ($row['SortOrder'] > $newOrder)	// if we find a record greater than the new step number we can stop decrementing record numbers
				break;
			$newSortOrder = $row['SortOrder'] - 1;
			pushUpdate($row['Id'],$newSortOrder);
		}
		$row = mysql_fetch_assoc($Recordset);
	}
}

if (isset($_GET['StepNumber']))
	$stepNumber = $_GET['StepNumber'];
if (isset($_GET['StepId']))
	$stepId = $_GET['StepId'];
if (isset($_GET['NewOrder']))
	$newOrder = $_GET['NewOrder'];
	
if (isset($_GET['Action']) && $_GET['Action'] == 'Delete') {
	resort();
}
if (isset($_GET['Action']) && $_GET['Action'] == 'Reorder') {
	reorder($stepNumber,$stepId,$newOrder);
}

if (isset($Recordset))
	mysql_free_result($Recordset);
?>