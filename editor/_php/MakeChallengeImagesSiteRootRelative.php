<?php require_once('../../Connections/projector.php'); ?>
<?php

/* This script makes all images site root relative
*/

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

$projectorConnection = mysqli_connect($hostname_projector, $username_projector, $password_projector, $database_projector);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

function makeMediaUrlSiteRelative($projectId) {
	global $projectorConnection;
	
	/* Select queries return a resultset */
	if ($result = mysqli_query($projectorConnection, "SELECT Id, ImgSmall, ImgMedium, ImgLarge FROM Projects WHERE Id = " . $projectId)) {
			$numMedia = mysqli_num_rows($result);
			printf("Select returned %d rows.\n", $numMedia);
			$result->data_seek(0);
			$array = array("ImgSmall", "ImgMedium", "ImgLarge");
			while ($row = $result->fetch_assoc()) {
	
			// delete all the Challenge Intro steps 
				for ($i=0;$i<count($array);$i++) {
					$url = $row[$array[$i]];	
					if (strlen($url) > 0 ) {
						$firstChar = $url[0];
						if ($firstChar != '/') {
							$url = '/' . $url;
							$sqlCommand = sprintf("UPDATE Projects SET %s=%s WHERE Id=%s", 
													 $array[$i],
													 GetSQLValueString($url, "text"),
													 GetSQLValueString($row['Id'], "int"));
							print "sql: " . $sqlCommand . "<br />\n";
							pushCommand($sqlCommand);
						} 
					}
				}
			}
			/* free result set */
			mysqli_free_result($result);
	}
}

/* iterate through all projects making sure all url's are site root relative */
function fixMediaUrlForProjects() {
	global $projectorConnection;
	$availableProjects = array();
	
	echo "<pre>\n";
	
	// find all the projects that are still available
	if ($result = mysqli_query($projectorConnection, "SELECT Id FROM Projects")) {
			$result->data_seek(0);
			
			while ($row = $result->fetch_assoc()) {
				$availableProjects[$row['Id']] = $row['Id']; 
				echo "Project#: " . $row['Id'] . "\n";
				makeMediaUrlSiteRelative($row['Id']);
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
	runCommands();
	echo "</pre>\n";
}

fixMediaUrlForProjects();
?>