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
$loremIpsumArray = array(	"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at pulvinar tellus.",
													"Suspendisse sem dui, pellentesque non condimentum sit amet, vehicula a ante.",
													"Aliquam ante metus, laoreet eu euismod vel, eleifend id sapien.",
													"Ut dapibus molestie arcu, nec accumsan felis suscipit in.", 
													"Nunc pretium placerat nulla sit amet porta. Nunc eleifend lorem vitae sapien lobortis eget pellentesque augue convallis.");
if ($totalRows_routinesRecordset > 0) {
	$rowStepNumber = 1;
	do {
		if (isset($row_routinesRecordset)) {
			// this Query needs to be UPDATED for COMMON CORE projects look for the TaskId instead of RoutineId
			$query_stepsRecordset = sprintf("SELECT Steps.Id, Steps.Title, Steps.SmallImage, Steps.Description, ProjectId, SortOrder, TemplateName, Name, RoutineId FROM Steps WHERE ProjectId = %s AND Steps.RoutineId = %s ORDER BY SortOrder",$ProjectId, $row_routinesRecordset['RoutineId']);
	//	print "query = $query_stepsRecordset\n<br />";
			$stepsRecordset = mysql_query($query_stepsRecordset, $projector) or die(mysql_error());
			$row_stepsRecordset = mysql_fetch_assoc($stepsRecordset);
			
			do {
				echo '<div class="ribbon-item" data-number="' . $rowStepNumber . '">' . "\n\t";
				//image
				$imageThumbnail = "_images/CC_UI/step_thumbnail.jpg";
				if (isset($row_stepsRecordset['SmallImage']) && $row_stepsRecordset['SmallImage'] != "")
					$imageThumbnail = $row_stepsRecordset['SmallImage'];
        		echo '<img class="ribbon-item-image" src="' . $imageThumbnail . '">' . "\n";
				//number
				echo '<p class="ribbon-item-number">' . $rowStepNumber . '</p>' . "\n\t";
				//title
				echo '<p class="ribbon-item-title">' . $row_stepsRecordset['Name'] . '</p>' . "\n\t";
				//description
				if (isset($row_stepsRecordset['Description']) && $row_stepsRecordset['Description'] != "")
					$stepDescription = $row_stepsRecordset['Description'];
				else
					$stepDescription = $loremIpsumArray[$rowStepNumber % 5];
				echo '<p class="ribbon-item-description">' . $stepDescription . '</p>' . "\n\t";
				
				echo '</div>' . "\n";
				$rowStepNumber++;			
			}  while ($row_stepsRecordset = mysql_fetch_assoc($stepsRecordset));
		}
	} while ($row_routinesRecordset = mysql_fetch_assoc($routinesRecordset));
}
?>
</div><!-- end of ribbon -->