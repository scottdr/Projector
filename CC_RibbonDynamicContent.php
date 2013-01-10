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

$ProjectId = 1;
if (isset($_GET['ProjectId'])) {
	$ProjectId = $_GET['ProjectId'];
}

mysql_select_db($database_projector, $projector);
//$query_stepsRecordset = sprintf("SELECT Steps.Id, ProjectId, SortOrder, TemplateName, Name, RoutineId, RoutineName, CSSName FROM Steps, Routines WHERE ProjectId = %s AND Steps.RoutineId = Routines.Id ORDER BY SortOrder",$ProjectId);
$query_routinesRecordset = sprintf("SELECT RoutineId, RoutineName, CSSName FROM RoutineAttach, Routines WHERE RoutineAttach.ProjectId = %s AND RoutineAttach.RoutineId = Routines.Id ORDER BY RoutineAttach.SortOrder",$ProjectId);
//print "query = $query_routinesRecordset\n<br />";
$routinesRecordset = mysql_query($query_routinesRecordset, $projector) or die(mysql_error());
$row_routinesRecordset = mysql_fetch_assoc($routinesRecordset);
//$subtractSlideShowStep = 0;
/*
if ($PROJECTOR['disableSlideShow']) {		// check if we have disabled the slide show feature and if so remove the first step
	// if the first step is using the Intro template and we are hiding
	if ($row_routinesRecordset['TemplateName'] == 'Intro.php') {	
		$subtractSlideShowStep = 1;
		$row_routinesRecordset = mysql_fetch_assoc($routinesRecordset);
	}
}
*/

$totalRows_routinesRecordset = mysql_num_rows($routinesRecordset);
//echo "# Records: $totalRows_routinesRecordset\n<br />";

$currentRoutineName = "";
$rowStepNumber = 1;
$currentRoutineId = -1;
$currentRoutineLevel = 0;
$rowNumber = 0;
$rowLoopNumber = 1;
$cssName = "_CC_Routine_" . $currentRoutineLevel;
if ($totalRows_routinesRecordset > 0)
	do {
		if (isset($row_routinesRecordset)) {
	//		$rowStepNumber = $row_routinesRecordset['SortOrder'] - $subtractSlideShowStep;
	//		print_r($row_routinesRecordset);
			if ($row_routinesRecordset['RoutineId'] != $currentRoutineId) {
				$currentRoutineLevel++;
				$cssName = "_CC_Routine" . $currentRoutineLevel;
				if ($currentRoutineId != -1)
					print "\n</div>\n"; // close off previous div when we need to
				$currentRoutineId = $row_routinesRecordset['RoutineId'];
				print "\n" . '<div class="ribbonBlock ribbonBlock-' . $rowLoopNumber . '" id="ribbon' . $cssName . '">';							// <div id="ribbonChallenge">
				print "\n  " . '<div class="ribbonHeader" id="ribbon' . $cssName . 'Top">'; 	//   <div id="ribbonChallengeTop">
				print "\n    " . '<h2>' . $row_routinesRecordset['RoutineName'] . '</h2>'; 				//   <h2>YOUR CHALLENGE</h2>
				print "\n  </div>";
				$currentRoutineName = $cssName;
				$rowLoopNumber++;
				if ($rowLoopNumber % 5 == 0) {
				   $rowLoopNumber = 1;
				}
			}
			
			$extra = ''; //Extra classes to add, such as 'current'
			$count = 1; 

			// this Query needs to be UPDATED for COMMON CORE projects look for the TaskId instead of RoutineId
			$query_stepsRecordset = sprintf("SELECT Steps.Id, ProjectId, SortOrder, TemplateName, Name, RoutineId FROM Steps WHERE ProjectId = %s AND Steps.RoutineId = %s ORDER BY SortOrder",$ProjectId, $row_routinesRecordset['RoutineId']);
	//	print "query = $query_stepsRecordset\n<br />";
			$stepsRecordset = mysql_query($query_stepsRecordset, $projector) or die(mysql_error());
			$row_stepsRecordset = mysql_fetch_assoc($stepsRecordset);
			
			if ($SelectedStepNumber == $rowStepNumber)
			$extra = 'current';

			do {
				print "\n  " . '<div class="' . $extra . ' singleRibbonBlock ribbon' . $cssName . 'ColumnWrap" data-type="wrapper" data-number="' . $rowStepNumber . '" data-id="' . $row_stepsRecordset['Id'] . '" data-count="' . $count . '" >'; 			
				print "\n    " . '<div class="ribbonBottom clearfix ribbon' . $cssName . 'Bottom" data-type="bottom">'; 	//   <div class="ribbonChallengeBottomCurrent">		
				print "\n      " . '<p class="ribbonOpeningNumber ' . $cssName . 'Number">' . $rowStepNumber . '</p>'; // <p class="ChallengeNumber">1</p>
				print "\n      " . '<h2>' . $cssName . '</h2>';  // <h2>Challenge Video</h2>
				
				
				print "\n    " . '</div>';
				print "\n    " . '<div class="ribbonSelector ribbon' . $cssName . 'Selector" data-type="selector"> </div>';
				
				print "\n  " . '</div>';
					$rowStepNumber++;	
					$extra = '';		
			}  while ($row_stepsRecordset = mysql_fetch_assoc($stepsRecordset));

		}
	} while ($row_routinesRecordset = mysql_fetch_assoc($routinesRecordset));
print "\n</div>"; // close off previous div when we need to

$totalRows_stepsRecordset = $rowStepNumber;

mysql_free_result($routinesRecordset);
?>