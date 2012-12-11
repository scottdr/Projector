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

// CODE FOR Pushing commands

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

// Database Code - Reorder steps 

$projector = mysqli_connect($hostname_projector, $username_projector, $password_projector, $database_projector);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

function reorderProject($projectId) {
	global $projector;
	
	/* Select queries return a resultset */
	if ($result = mysqli_query($projector, sprintf("SELECT * FROM Steps WHERE ProjectId = %s ORDER BY RoutineId, SortOrder",$projectId))) {
			$numSteps = mysqli_num_rows($result);
			printf("Select returned %d rows.\n", $numSteps);
			$result->data_seek(0);
			$routineId = 1;
			$stepOrder = 1;
			while ($row = $result->fetch_assoc()) {
				print "Id: " . $row['Id'] . " RoutineId: " . $row['RoutineId'] . " SortOrder: " . $row['SortOrder'] . " Name: " . $row['Name'] . " Template: " . $row['TemplateName'] . "\n";
				// delete all the Challenge Intro steps 
				if ($routineId != $row['RoutineId']) {
					$stepOrder = 1;
					$routineId = $row['RoutineId'];
				}
				if ($row['TemplateName'] == "Intro.php") {
						$deleteSQL = sprintf("DELETE FROM Steps WHERE Id=%s",
												 GetSQLValueString($row['Id'], "int"));
						print "$deleteSQL\n";
				} else {
					$sqlCommand = sprintf("UPDATE Steps SET SortOrder=%s WHERE Id=%s",
                       GetSQLValueString($stepOrder, "int"),
											 GetSQLValueString($row['Id'], "int"));
					print "$sqlCommand\n";
					$stepOrder++;
				}
			}
				
			/* free result set */
			mysqli_free_result($result);
	}
}

function reorderAllProjects() {
	global $projector;
	$availableProjects = array();
	
	echo "<pre>\n";
	
	// find all the projects that are still available
	if ($result = mysqli_query($projector, "SELECT Id FROM projects")) {
			$result->data_seek(0);
			
			while ($row = $result->fetch_assoc()) {
				$availableProjects[$row['Id']] = $row['Id']; 
				echo "Project#: " . $row['Id'] . "\n";
				reorderProject($row['Id']);
			}
			
				/* free result set */
			mysqli_free_result($result);
	}
	
	/* find all of the projects that are in the steps */
	/*
	if ($result = mysqli_query($projector, "SELECT DISTINCT ProjectId FROM Steps")) {
			$result->data_seek(0);
			
			while ($row = $result->fetch_assoc()) {
				echo $row['ProjectId'] . "\n";
				if ($availableProjects[$row['ProjectId']] != $row['ProjectId']) {
					//this particular step is not in an existing project delete it!
					$deleteSQL = sprintf("DELETE FROM Steps WHERE ProjectId=%s",
												 GetSQLValueString($row['ProjectId'], "int"));
					print "$deleteSQL\n";
				}
			}
			
			// free result set 
			mysqli_free_result($result);
	} */
	echo "</pre>\n";
}

reorderAllProjects();
?>