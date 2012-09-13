<?php require_once('Connections/projector.php'); ?>
<?php

// this is the query to do a JOIN of the Medias attached to the current step get their url, Caption

mysql_select_db($database_projector, $projector);
$sqlStatement = "SELECT Media.Id, MediaAttach.Id as MediaAttachId, Media.Caption, Media.Url FROM Media, MediaAttach WHERE MediaAttach.MediaId = Media.Id AND MediaAttach.StepId = " . $_SESSION['StepId'];
$media = mysql_query($sqlStatement, $projector) or die(mysql_error());
$media_steps = mysql_fetch_assoc($media);

?>
<?php do { ?><div style="display:block; float:left;"> <img name="Id=<?php echo $media_steps['Id']; ?>" src="<?php echo $media_steps['Url']; ?>" width="100" height="80" alt="<?php echo $media_steps['Caption']; ?>">
<div style="text-align:center; margin-top:5px;">
<a class="smallRedButton" href="DetachMedia.php?MediaAttachId=<?php echo $media_steps['MediaAttachId']; ?>&StepId=<?php echo $_SESSION['StepId']; ?>">Detach</a>
</div>
</div>
<?php } while ($media_steps = mysql_fetch_assoc($media)); ?>
<?php
mysql_free_result($media);
?>