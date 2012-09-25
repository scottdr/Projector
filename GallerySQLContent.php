<?php

function getGrade()
{
	global $row_Recordset1;
	
	if ($row_Recordset1['GradeMin'] == $row_Recordset1['GradeMax']) {
		return "Grade: " . $row_Recordset1['GradeMin'];
	} else {
		return "Grades: " . $row_Recordset1['GradeMin'] . ' - ' . $row_Recordset1['GradeMax'];
	}
}

function getDuration()
{
	global $row_Recordset1;
	
	$numWeeks = round($row_Recordset1['Duration'] / 5);
	$numDays = $row_Recordset1['Duration'] % 5;
	$durationStr = '';
	if ($numWeeks > 1) {
		$durationStr =  $numWeeks . " Weeks ";
	}  else if ($numWeeks == 1) {
		$durationStr =  $numWeeks . " Week ";
	}
	if ($numDays > 1) {
		$durationStr .= $numDays . " Days";
	}
	else if ($numDays == 1) {
		$durationStr .= $numDays . " Day";
	}
	return $durationStr;
}

$columnNum = 1; 
do { 
	print "<div class=\"GalleryColumn" .  $columnNum . "Div\"" . "data-id=\"" . $row_Recordset1['Id'] . "\" >";
	if ($row_Recordset1['Status'] == "Pilot")
		print "<div class=\"GalleryBlueBar\"></div>";
	if ($row_Recordset1['Status'] != "Pilot")
		print "<div class=\"GalleryBlueBar\" style=\"visibility: hidden;\"></div>";
	if ($row_Recordset1['Topic'] == "1")
  	print "<div class=\"GalleryThumbnailIcon\"></div>";
	print "\n\t<div class=\"GalleryMedia\">";
	print "\n\t\t<a href=\"ProjectDetails.php?Id=" . $row_Recordset1['Id']. "\"><img src=\"" . $row_Recordset1['ImgSmall'] . "\" width=\"300\" height=\"200\"></a>";
	print "\n\t</div>";
	print "\n\t<div class=\"GalleryDetails\">";
	print "\n\t\n\t<h1>" . $row_Recordset1['Name']. "</h1>";
	print "\n\t\n\t<p>" . $row_Recordset1['Description'] . "</p>";
	print "\n\t\n\t<p></p>";
	print "\n\t\n\t<p>Subject: " . $row_Recordset1['Subject'] . "</p>";
	print "\n\t\n\t<p>Grade: " . getGrade() . "</p>";
	print "\n\t\n\t<p>Duration: " . getDuration() . "</p>";
	print "\n\t</div>";
	print "\n</div>\n";
	if (++$columnNum > 3)
			$columnNum = 1;
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));

mysql_free_result($Recordset1);
?>
