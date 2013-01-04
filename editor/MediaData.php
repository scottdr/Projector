<?php require_once('../Connections/projector.php'); ?>
<?php

/* This php file returns the html code to populate the Attach Media dialog it is a table with thumbnail of images and checkbox to select them */


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

$colname_MediaQuery = "-1";
if (isset($_GET['ProjectId'])) {
  $colname_MediaQuery = $_GET['ProjectId'];
}
if (isset($_GET['StepId'])) {
  $stepId = $_GET['StepId'];
}

$width = 0;
$height = 0;
if (isset($_GET['Size'])) {
  $size = $_GET['Size'];
	$sizeParts = explode('x',$size);
	if ($sizeParts > 1) {
		$width = $sizeParts[0];
		$height = $sizeParts[1];
	}
}

$tableName = "Media";
if (isset($_GET['type'])) {
	$type = $_GET['type'];
	switch ($type) {
		case 'video' : 	$tableName = "Video";
										break;
		default : $tableName = "Media";
							break;
	}
} else
	$type = "image";

// TO DO handle case where you do not specify a project Id but you specify a size
mysql_select_db($database_projector, $projector);
if ($colname_MediaQuery == -1)
	$query_MediaQuery = sprintf("SELECT * FROM %s", $tableName);
else {
	$query_MediaQuery = sprintf("SELECT * FROM %s WHERE projectId = %s", $tableName, GetSQLValueString($colname_MediaQuery, "int"));
	if ($width > 0 && $height > 0)
		$query_MediaQuery .= sprintf(" AND Width = %s AND Height = %s", $width, $height);
}

$MediaQuery = mysql_query($query_MediaQuery, $projector) or die(mysql_error());
$totalRows_MediaQuery = mysql_num_rows($MediaQuery);
$row_MediaQuery = mysql_fetch_assoc($MediaQuery);


session_start();


// PHP Code to call to Attach media either to a Slide or to A Step defaults to AttachMedia.php = Attach to Step
// but if $_SESSION['attachTo'] = "slide" then use AttachSlideMedia to attach it to a Slide
$attachURL = "_php/AttachMedia.php";

// SCOTT TO DO COMMENT THIS BACK IN PASS Step ID

if (isset($_GET['attachTo']) && $_GET['attachTo'] == "slide")
	$attachURL = "_php/AttachSlideMedia.php?SlideId=" . $_SESSION['SlideId'] /*. "&SortOrder=" . $_SESSION['SortOrder']*/;
else
	$attachURL = "_php/AttachMedia.php?ProjectId=" . $_GET['ProjectId'] . "&StepId=" . $_GET['StepId'] . "&type=" . $type;

?>
<div style="text-align:center">
<table id="MediaTable" width="420	" class="table table-striped table-hover clearFloat">
  <thead>
                    <tr>
                        <th width="10">Attach</th>
                      	<th width="100">Image</th>
                        <th width="200">Caption</th>
                        <th width="100">Dimensions</th>
                    </tr>
  </thead>
  <tbody>
		<?php $rowNum = 0;
					do {
            // set the thumbnail url 
            switch ($type) {
              case "image" : 	$thumbnailUrl = $row_MediaQuery['Url'];
                              break;
              case "video" :  $thumbnailUrl = $row_MediaQuery['PosterUrl'];
                              break;
            }
    ?>
    
    <tr class="rowItem">
        <td width="10"><input type="checkbox" value="checked" id="<?php echo $row_MediaQuery['Id']; ?>"></td>
        <td width="100"><a href="<?php echo $attachURL; ?>&MediaId=<?php echo $row_MediaQuery['Id']; ?>"><img src="<?php echo $thumbnailUrl; ?>" class="img-polaroid" width="100" height="100" /></a></td>
        <td width="200" nowrap="nowrap"><div class="captionDiv"><?php echo $row_MediaQuery['Caption']; ?></div></td>
        <td width="100" nowrap="nowrap"><?php if (isset($row_MediaQuery['Width']) && isset($row_MediaQuery['Height'])) echo $row_MediaQuery['Width'] . "x" . $row_MediaQuery['Height']; ?></td>
      </tr>
     <?php $rowNum++; } while ($row_MediaQuery = mysql_fetch_assoc($MediaQuery)); ?>
   </tbody>
</table>
</div>
<?php

mysql_free_result($MediaQuery);
?>
