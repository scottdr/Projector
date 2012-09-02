<?php require_once('Connections/projector.php'); ?>
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

$StepNumber = 1;

$ProjectId = 1;
if (isset($_GET['ProjectId'])) {
	$ProjectId = $_GET['ProjectId'];
}

mysql_select_db($database_projector, $projector);
$query_stepsRecordset = sprintf("SELECT Steps.Id, ProjectId, SortOrder, TemplateName, LessonName, RoutineId, RoutineName, CSSName FROM Steps, Routines WHERE ProjectId = %s AND Steps.RoutineId = Routines.Id ORDER BY SortOrder",$ProjectId);
$stepsRecordset = mysql_query($query_stepsRecordset, $projector) or die(mysql_error());
$row_stepsRecordset = mysql_fetch_assoc($stepsRecordset);
$totalRows_stepsRecordset = mysql_num_rows($stepsRecordset);
$currentRoutineName = "";
$stepsArray = array();
$rowNumber = 0;
do {
	if (isset($row_stepsRecordset)) {
		if ($row_stepsRecordset['CSSName'] != $currentRoutineName) {
			if ($currentRoutineName != '')
				print "\n</div>\n"; // close off previous div when we need to
			print "\n" . '<div id="ribbon' . $row_stepsRecordset['CSSName'] . '">';							// <div id="ribbonChallenge">
			print "\n  " . '<div id="ribbon' . $row_stepsRecordset['CSSName'] . 'Top">'; 	//   <div id="ribbonChallengeTop">
			print "\n    " . '<h2>' . $row_stepsRecordset['RoutineName'] . '</h2>'; 				//   <h2>YOUR CHALLENGE</h2>
			print "\n  </div>";
			$currentRoutineName = $row_stepsRecordset['CSSName'];
		}
		
		print "\n  " . '<div class="ribbon' . $row_stepsRecordset['CSSName'] . 'ColumnWrap" data-type="wrapper" data-number="' . $row_stepsRecordset['SortOrder'] . '" data-id="' . $row_stepsRecordset['Id'] . '" >'; 			// <div class="ribbonChallengeColumnWrap">
		if ($StepNumber == $row_stepsRecordset['SortOrder']) {	// if the step number is the currently selected one set class to BottomCurrent
			print "\n    " . '<div class="ribbon' . $row_stepsRecordset['CSSName'] . 'BottomCurrent" data-type="bottom">'; 	//   <div class="ribbonChallengeBottomCurrent">
		} else
			print "\n    " . '<div class="ribbon' . $row_stepsRecordset['CSSName'] . 'Bottom" data-type="bottom">'; 	//   <div class="ribbonChallengeBottomCurrent">		
		print "\n      " . '<p class="' . $row_stepsRecordset['CSSName'] . 'Number">' . $row_stepsRecordset['SortOrder'] . '</p>'; // <p class="ChallengeNumber">1</p>
		print "\n      " . '<h2>' . $row_stepsRecordset['LessonName'] . '</h2>';  // <h2>Challenge Video</h2>
		print "\n    " . '</div>';
		if ($StepNumber == $row_stepsRecordset['SortOrder'])
			print "\n    " . '<div class="ribbon' . $row_stepsRecordset['CSSName'] . 'Selector visibleStyle" data-type="selector"> </div>'; 
		else
			print "\n    " . '<div class="ribbon' . $row_stepsRecordset['CSSName'] . 'Selector hiddenStyle" data-type="selector"> </div>';
		print "\n  " . '</div>';
		$stepsArray[] = $row_stepsRecordset;
		$rowNumber++;
	}
} while ($row_stepsRecordset = mysql_fetch_assoc($stepsRecordset));
print "\n</div>"; // close off previous div when we need to

mysql_free_result($stepsRecordset);
?>
