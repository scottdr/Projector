<?php

// does a JOIN of the Medias attached to the specified step returns an array of results for each image with the Media, Caption & URL
function GetMediaForStep($StepId,$mediaType) {
	global $database_projector, $projector;
	$rowArray = array();
	
	mysql_select_db($database_projector, $projector);
	
	// Scan for image media.
	$sqlStatement = "SELECT Media.Id, Media.Caption, Media.Url, MediaAttach.Type FROM Media, MediaAttach WHERE MediaAttach.MediaId = Media.Id AND MediaAttach.Type != 1 AND MediaAttach.StepId = " . $StepId;
	$media = mysql_query($sqlStatement, $projector) or die(mysql_error());
	$media_steps = mysql_fetch_assoc($media);
	do {
		if ($media_steps)
			$rowArray[] = $media_steps;
	} while ($media_steps = mysql_fetch_assoc($media));
	mysql_free_result($media);
	
	// Scan for video media.
	$sqlStatement = "SELECT Video.Id, Video.Caption, Video.mp4Url, Video.PosterUrl, Video.Width, Video.Height, MediaAttach.Type FROM Video, MediaAttach WHERE MediaAttach.MediaId = Video.Id AND MediaAttach.Type = 1 AND MediaAttach.StepId = " . $StepId;
	$media = mysql_query($sqlStatement, $projector) or die(mysql_error());
	$media_steps = mysql_fetch_assoc($media);
	do {
		if ($media_steps)
			$rowArray[] = $media_steps;
	} while ($media_steps = mysql_fetch_assoc($media));
	mysql_free_result($media);
	
	return $rowArray;
}

function GenerateImageTag($rowNumber) {
	global $mediaArray;
	if ($rowNumber < count($mediaArray))
		$rowData = $mediaArray[$rowNumber];
	if (isset($rowData)) {
		print '<img name="Id=' . $rowData['Id'] . '" src="' . $rowData['Url'] . '" title="' . $rowData['Type'] . $rowData['Caption'] . '" alt="' . $rowData['Caption'] . '" />';
		print '<p class="caption">' . $rowData['Caption'] . '</p>';
	} else
		print '<img src="lessonTemplates/images/mountains.jpg" />';
}

function GenerateMediaTag($rowNumber) {
	global $mediaArray;
	if ($rowNumber < count($mediaArray))
		$rowData = $mediaArray[$rowNumber];
	if (isset($rowData)) {
		switch ($rowData['Type'])
		{
			case 0:
				GenerateImageTag($rowNumber);
				break;
			case 1:
				GenerateVideoTag($rowNumber);
				break;
			default:
				GenerateImageTag($rowNumber);
				break;
		}
	}
}

function GenerateVideoTag($rowNumber) {
	global $mediaArray;
	if ($rowNumber < count($mediaArray))
		$rowData = $mediaArray[$rowNumber];
	if (isset($rowData)) {
		print '<video id="Id=' . $rowData['Id'] . '" class="video-js vjs-default-skin" controls preload="auto" ';
		if ($rowData['Width'] && $rowData['Height'])
			print 'width="' . $rowData['Width'] . '" height="' . $rowData['Height'] . '"';
		if ($rowData['PosterUrl'])
			print 'poster="' . $rowData['PosterUrl'] . '"';
		print ' >';
		print '\t<source src="' . $rowData['mp4Url'] . '" type=\'video/mp4\'>';
		print '</video>';
		//print implode(",", $rowData);
	} else
		print '<img src="lessonTemplates/images/mountains.jpg" />';
}

//$mediaArray = GetMediaForStep($StepId);
?>
