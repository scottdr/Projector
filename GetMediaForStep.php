<?php

// does a JOIN of the Medias attached to the specified step returns an array of results for each image with the Media, Caption & URL
function GetMediaForStep($StepId) {
	global $database_projector, $projector;
	
	mysql_select_db($database_projector, $projector);
	$sqlStatement = "SELECT Media.Id, Media.Caption, Media.Url FROM Media, MediaAttach WHERE MediaAttach.MediaId = Media.Id AND MediaAttach.StepId = " . $StepId;
	$media = mysql_query($sqlStatement, $projector) or die(mysql_error());
	$media_steps = mysql_fetch_assoc($media);
	$rowArray = array();
	do {
		if ($media_steps)
			$rowArray[] = $media_steps; 
//		print '<img name="Id=' . $media_steps['Id'] . '" src="' . $media_steps['Url'] . '" width="100" height="80" alt="' . $media_steps['Caption'] . '">';
	} while ($media_steps = mysql_fetch_assoc($media));
	mysql_free_result($media);
	return $rowArray;
}

function GenerateImageTag($rowNumber) {
	global $mediaArray;
	if ($rowNumber < count($mediaArray))
		$rowData = $mediaArray[$rowNumber];
	if (isset($rowData)) {
		print '<img name="Id=' . $rowData['Id'] . '" src="' . $rowData['Url'] . '" title="' . $rowData['Caption'] . '" alt="' . $rowData['Caption'] . '" />';
		print '<p class="caption">' . $rowData['Caption'] . '</p>';
	} else
		print '<img src="lessonTemplates/images/mountains.jpg" />';
}

//$mediaArray = GetMediaForStep($StepId);
?>
