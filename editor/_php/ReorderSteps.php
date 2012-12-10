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

/* Perform a Query based on the project ID and Routine Id
*/
function doQuery($projectId,$routineId)
{
	global $database_projector, $projector, $recordCount, $Recordset, $row;
	if (isset($projectId) && isset($routineId)) {
		$sqlQuery = sprintf("SELECT Steps.Id, Steps.Name, Steps.RoutineId, Steps.SortOrder FROM Steps WHERE Steps.ProjectId = %s AND Steps.RoutineId = %s ORDER By SortOrder",$projectId,$routineId);
		
		mysql_select_db($database_projector, $projector);
		$Recordset = mysql_query($sqlQuery, $projector) or die(mysql_error());
		$row = mysql_fetch_assoc($Recordset);
		$recordCount = mysql_num_rows($Recordset);
		print "record # $recordCount\n";
	} 
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


?Action=Delete&StepNumber=3&StepId=13&RoutineId=1

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
?Action=Reorder&AtepNumber=3&StepId=13&RoutineId=1&NewOrder=1

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
?action=Reorder&StepNumber=2 & StepId=12&RoutineId=1&NewOrder=4

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
	global $recordCount, $row, $Recordset;
	echo "stepNumber = " . $stepNumber . ", Id = " . $stepId . ", NewOrder = " . $newOrder . "\n<br />";
	for ($i=0;$i<$recordCount;$i++) {
		echo "Id = " . $row['Id']. ", Order = " . $row['SortOrder'] . "\n<br />"; 
		// we are moving the Step forward at the beggining of the list, so increment everything before it up to where it was in the list
		if ($stepNumber > $newOrder && $row['SortOrder'] >= $newOrder) {
			// stop when we get to the place where it was originally in the list 
			if ($row['SortOrder'] >= $stepNumber)
				break;
			if ($row['Id'] != $stepId) {	// if we are at the step we are repositioning don't update it 
				$newSortOrder = $row['SortOrder'] + 1;
				echo '$row[\'SortOrder\'] >= $newOrder' . "\n<br />";
				pushUpdate($row['Id'],$newSortOrder);
			}
		} 	
		if ($row['Id'] == $stepId) {
			$newSortOrder = $newOrder;
			pushUpdate($row['Id'],$newSortOrder);
			echo '$row[\'Id\'] == $stepId' . "\n<br />";
		} else
		// we are moving beyond the existing item
		if ($row['SortOrder'] > $stepNumber && $newOrder > $stepNumber) {
			if ($row['SortOrder'] > $newOrder)	// if we find a record greater than the new step number we can stop decrementing record numbers
				break;
			echo '$row[\'SortOrder\'] > $stepNumber' . "\n<br />";
			$newSortOrder = $row['SortOrder'] - 1;
			pushUpdate($row['Id'],$newSortOrder);
		}
		$row = mysql_fetch_assoc($Recordset);
	}
	runCommands();
}

if (isset($_GET['StepNumber']))
	$stepNumber = $_GET['StepNumber'];
if (isset($_GET['StepId']))
	$stepId = $_GET['StepId'];
if (isset($_GET['NewOrder']))
	$newOrder = $_GET['NewOrder'];
	
if (isset($_GET['Action']) && $_GET['Action'] == 'Delete') {
	doQuery($projectId,$routineId);
	resort();
}
if (isset($_GET['Action']) && $_GET['Action'] == 'Reorder') {
	doQuery($projectId,$routineId);
	reorder($stepNumber,$stepId,$newOrder);
}

if (isset($Recordset))
	mysql_free_result($Recordset);

if (isset($_GET['GoTo']))
	header(sprintf("Location: %s", $_GET['GoTo'])); 
?>