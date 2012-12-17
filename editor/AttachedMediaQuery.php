<?php require_once('../Connections/projector.php'); ?>
<?php

// this is the query to do a JOIN of the Medias attached to the current step get their url, Caption
$stepId = -1;
if (isset($_GET['StepId']))
	$stepId = $_GET['StepId'];

mysql_select_db($database_projector, $projector);
$sqlStatement = "SELECT Media.Id, MediaAttach.Id as MediaAttachId, Media.Caption, Media.Url FROM Media, MediaAttach WHERE MediaAttach.MediaId = Media.Id AND MediaAttach.StepId = " . $stepId;
$media = mysql_query($sqlStatement, $projector) or die(mysql_error());
$media_steps = mysql_fetch_assoc($media);

?>
<?php if ($media_steps > 0): ?>
<?php do { ?><div style="display:block; float:left;"> <img name="Id=<?php echo $media_steps['Id']; ?>" src="<?php echo $media_steps['Url']; ?>" width="100" alt="<?php echo $media_steps['Caption']; ?>" class="img-polaroid">
<div style="text-align:center; margin-top:5px;">
<a class="smallRedButton" href="DetachMedia.php?MediaAttachId=<?php echo $media_steps['MediaAttachId']; ?>&StepId=<?php echo $_SESSION['StepId']; ?>">Detach</a>
</div>
</div>
<?php } while ($media_steps = mysql_fetch_assoc($media)); ?>
<?php endif; ?>
<?php
mysql_free_result($media);
?>
<?php

// this is the query to do a JOIN of the Medias attached to the current step get their url, Caption

mysql_select_db($database_projector, $projector);
$sqlStatement = "SELECT Video.Id, MediaAttach.Id as MediaAttachId, Video.Caption, Video.PosterUrl FROM Video, MediaAttach WHERE MediaAttach.MediaId = Video.Id AND MediaAttach.StepId = " . $stepId;
$video = mysql_query($sqlStatement, $projector) or die(mysql_error());
$video_steps = mysql_fetch_assoc($video);

?>
<?php if ($video_steps > 0): ?>
<?php do { ?><div style="display:block; float:left;"> <img name="Id=<?php echo $video_steps['Id']; ?>" src="<?php echo $video_steps['PosterUrl']; ?>" width="100" alt="<?php echo $video_steps['Caption']; ?>">
<div style="text-align:center; margin-top:5px;">
<a class="smallRedButton" href="DetachMedia.php?MediaAttachId=<?php echo $video_steps['MediaAttachId']; ?>&StepId=<?php echo $_SESSION['StepId']; ?>">Detach</a>
</div>
</div>
<?php } while ($video_steps = mysql_fetch_assoc($video)); ?>
<?php endif; ?>
<?php
mysql_free_result($video);
?>