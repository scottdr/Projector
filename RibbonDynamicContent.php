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

$SelectedStepNumber = 1;

$ProjectId = 1;
if (isset($_GET['ProjectId'])) {
	$ProjectId = $_GET['ProjectId'];
}

mysql_select_db($database_projector, $projector);
$query_stepsRecordset = sprintf("SELECT Steps.Id, ProjectId, SortOrder, TemplateName, Name, RoutineId, RoutineName, CSSName FROM Steps, Routines WHERE ProjectId = %s AND Steps.RoutineId = Routines.Id ORDER BY SortOrder",$ProjectId);
$stepsRecordset = mysql_query($query_stepsRecordset, $projector) or die(mysql_error());
$row_stepsRecordset = mysql_fetch_assoc($stepsRecordset);
$subtractSlideShowStep = 0;
if ($PROJECTOR['disableSlideShow']) {		// check if we have disabled the slide show feature and if so remove the first step
	// if the first step is using the Intro template and we are hiding
	if ($row_stepsRecordset['TemplateName'] == 'Intro.php') {	
		$subtractSlideShowStep = 1;
		$row_stepsRecordset = mysql_fetch_assoc($stepsRecordset);
	}
}

$totalRows_stepsRecordset = mysql_num_rows($stepsRecordset);
$currentRoutineName = "";
$stepsArray = array();
$rowNumber = 0;
$rowsWithPips = array(3,5); //random steps to add pips too
do {
	if (isset($row_stepsRecordset)) {
		$rowStepNumber = $row_stepsRecordset['SortOrder'] - $subtractSlideShowStep;
		if ($row_stepsRecordset['CSSName'] != $currentRoutineName) {
			if ($currentRoutineName != '')
				print "\n</div>\n"; // close off previous div when we need to
			print "\n" . '<div class="ribbonBlock" id="ribbon' . $row_stepsRecordset['CSSName'] . '">';							// <div id="ribbonChallenge">
			print "\n  " . '<div class="ribbonHeader" id="ribbon' . $row_stepsRecordset['CSSName'] . 'Top">'; 	//   <div id="ribbonChallengeTop">
			print "\n    " . '<h2>' . $row_stepsRecordset['RoutineName'] . '</h2>'; 				//   <h2>YOUR CHALLENGE</h2>
			print "\n  </div>";
			$currentRoutineName = $row_stepsRecordset['CSSName'];
		}
		
		$extra = ''; //Extra classes to add, such as 'current'
		$count = 1; //NOTE: Set this variable to show pips
		
		if ($SelectedStepNumber == $rowStepNumber)
			$extra = 'current';
		if(in_array($rowStepNumber, $rowsWithPips))
			$count = 5;
		
		print "\n  " . '<div class="' . $extra . ' singleRibbonBlock ribbon' . $row_stepsRecordset['CSSName'] . 'ColumnWrap" data-type="wrapper" data-number="' . $rowStepNumber . '" data-id="' . $row_stepsRecordset['Id'] . '" data-count="' . $count . '" >'; 			
		print "\n    " . '<div class="ribbonBottom ribbon' . $row_stepsRecordset['CSSName'] . 'Bottom" data-type="bottom">'; 	//   <div class="ribbonChallengeBottomCurrent">		
		print "\n      " . '<p class="ribbonOpeningNumber ' . $row_stepsRecordset['CSSName'] . 'Number">' . $rowStepNumber . '</p>'; // <p class="ChallengeNumber">1</p>
		print "\n      " . '<h2>' . $row_stepsRecordset['Name'] . '</h2>';  // <h2>Challenge Video</h2>
		
		//Pip code
		if($count > 1)
		{
			print '<div class="pips">
						<a class="pip active" href="#"></a>
						<a class="pip" href="#"></a>
						<a class="pip" href="#"></a>
						<a class="pip" href="#"></a>
						<a class="pip" href="#"></a>
					</div>';
		}
		//End of pip code
		
		print "\n    " . '</div>';
		print "\n    " . '<div class="ribbonSelector ribbon' . $row_stepsRecordset['CSSName'] . 'Selector" data-type="selector"> </div>';
		
		print "\n  " . '</div>';
		$stepsArray[] = $row_stepsRecordset;
		$rowNumber++;
	}
} while ($row_stepsRecordset = mysql_fetch_assoc($stepsRecordset));
print "\n</div>"; // close off previous div when we need to

mysql_free_result($stepsRecordset);
?>
