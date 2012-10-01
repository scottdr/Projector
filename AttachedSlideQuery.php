<?php require_once('Connections/projector.php'); ?>
<?php

// this is the query to do a JOIN of the Medias attached to the current step get their url, Caption

mysql_select_db($database_projector, $projector);
$sqlStatement = "SELECT Media.Id, SlideAttach.Id as SlideAttachId, Media.Caption, Media.Url FROM Media, SlideAttach WHERE SlideAttach.MediaId = Media.Id AND SlideAttach.SlideId = " . $_SESSION['SlideId'];
$media = mysql_query($sqlStatement, $projector) or die(mysql_error());
$media_data = mysql_fetch_assoc($media);
$media_count = mysql_num_rows($media); 
?>
<?php	do { ?><div style="display:block; float:left;"> <img name="Id=<?php echo $media_data['Id']; ?>" src="<?php echo $media_data['Url']; ?>" width="100" height="80" alt="<?php echo $media_data['Caption']; ?>">
<div style="text-align:center; margin-top:5px;">
<a class="smallRedButton" href="DetachSlideMedia.php?SlideAttachId=<?php echo $media_data['SlideAttachId']; ?>&SlideId=<?php echo $_SESSION['SlideId']; ?>">Detach</a>
</div>
</div>
<?php } while ($media_data = mysql_fetch_assoc($media)); ?>
<?php
mysql_free_result($media);
?>