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

if ($totalRows_routinesRecordset > 0)
	do {
		if (isset($row_routinesRecordset)) {
	//		$rowStepNumber = $row_routinesRecordset['SortOrder'] - $subtractSlideShowStep;
	//		print_r($row_routinesRecordset);
			if ($row_routinesRecordset['CSSName'] != $currentRoutineName) {
				if ($currentRoutineName != '')
					print "\n</div>\n"; // close off previous div when we need to
				print "\n" . '<div id="ribbon' . $row_routinesRecordset['CSSName'] . '">';							// <div id="ribbonChallenge">
				print "\n  " . '<div id="ribbon' . $row_routinesRecordset['CSSName'] . 'Top">'; 	//   <div id="ribbonChallengeTop">
				print "\n    " . '<h2>' . $row_routinesRecordset['RoutineName'] . '</h2>'; 				//   <h2>YOUR CHALLENGE</h2>
				print "\n  </div>";
				$currentRoutineName = $row_routinesRecordset['CSSName'];
			}
			
			// this Query needs to be UPDATED for COMMON CORE projects look for the TaskId instead of RoutineId
			$query_stepsRecordset = sprintf("SELECT Steps.Id, ProjectId, SortOrder, TemplateName, Name, RoutineId FROM Steps WHERE ProjectId = %s AND Steps.RoutineId = %s ORDER BY SortOrder",$ProjectId, $row_routinesRecordset['RoutineId']);
	//	print "query = $query_stepsRecordset\n<br />";
			$stepsRecordset = mysql_query($query_stepsRecordset, $projector) or die(mysql_error());
			$row_stepsRecordset = mysql_fetch_assoc($stepsRecordset);
			
			do {
				print "\n  " . '<div class="ribbon' . $row_routinesRecordset['CSSName'] . 'ColumnWrap" data-type="wrapper" data-number="' . $rowStepNumber . '" data-id="' . $row_stepsRecordset['Id'] . '" ' . 'ontouchstart="touchStart(event,\'step\');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);"' . ' >'; 			// <div class="ribbonChallengeColumnWrap">
					if ($SelectedStepNumber == $rowStepNumber) {	// if the step number is the currently selected one set class to BottomCurrent
						print "\n    " . '<div class="ribbon' . $row_routinesRecordset['CSSName'] . 'BottomCurrent" data-type="bottom">'; 	//   <div class="ribbonChallengeBottomCurrent">
					} else
						print "\n    " . '<div class="ribbon' . $row_routinesRecordset['CSSName'] . 'Bottom" data-type="bottom">'; 	//   <div class="ribbonChallengeBottomCurrent">		
					print "\n      " . '<p class="' . $row_routinesRecordset['CSSName'] . 'Number">' . $rowStepNumber . '</p>'; // <p class="ChallengeNumber">1</p>
					print "\n      " . '<h2>' . $row_stepsRecordset['Name'] . '</h2>';  // <h2>Challenge Video</h2>
					print "\n    " . '</div>';
					if ($SelectedStepNumber == $rowStepNumber)
						print "\n    " . '<div class="ribbon' . $row_routinesRecordset['CSSName'] . 'Selector visibleStyle" data-type="selector"> </div>'; 
					else
						print "\n    " . '<div class="ribbon' . $row_routinesRecordset['CSSName'] . 'Selector hiddenStyle" data-type="selector"> </div>';
					print "\n  " . '</div>';
					$rowStepNumber++;			
			}  while ($row_stepsRecordset = mysql_fetch_assoc($stepsRecordset));
		
		}
	} while ($row_routinesRecordset = mysql_fetch_assoc($routinesRecordset));
print "\n</div>"; // close off previous div when we need to

$totalRows_stepsRecordset = $rowStepNumber;

mysql_free_result($routinesRecordset);
?>