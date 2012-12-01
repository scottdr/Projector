<?php

// does a JOIN of the Medias attached to the specified step returns an array of results for each image with the Media, Caption & URL
function GetMediaForStep($StepId,$mediaType) {
	global $database_projector, $projector;
	
	mysql_select_db($database_projector, $projector);
	if ($mediaType == "video")
		$sqlStatement = "SELECT Video.Id, Video.Caption, Video.mp4Url, Video.PosterUrl, Video.Width, Video.Height FROM Video, MediaAttach WHERE MediaAttach.MediaId = Video.Id AND MediaAttach.StepId = " . $StepId;
	else
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

/*
<video id="my_video_1" class="video-js vjs-default-skin" controls
  preload="auto" width="960" height="540" poster="my_video_poster.png"
  data-setup="{}">
 <source src="xml/lessons/math-6.4.2/video/mth_6_4_2_egg%20problem.mp4" type='video/mp4'>
</video>
*/
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
	} else
		print '<img src="lessonTemplates/images/mountains.jpg" />';
}

//$mediaArray = GetMediaForStep($StepId);
?>
