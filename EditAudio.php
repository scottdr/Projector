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

$audioId = "-1";
if (isset($_GET['Id'])) {
  $audioId = $_GET['Id'];
}

$projectId = -1;
if (isset($_GET['ProjectId'])) {
  $projectId = $_GET['ProjectId'];
}

// always do the query it will clear out $media_steps if the media object does not already exist
mysql_select_db($database_projector, $projector);
if ($projectId >= 0 )
	$query_audio = "SELECT * FROM Audio WHERE ProjectId = " . $projectId;
else
	$query_audio = "SELECT * FROM Audio WHERE Id = " . $audioId;

//print "sql: " . $query_audio . "\n<br />";	
$audioQuery = mysql_query($query_audio, $projector) or die(mysql_error());
$audio_data = mysql_fetch_assoc($audioQuery);
$audioId = $audio_data['Id'];
$totalRows = mysql_num_rows($audioQuery); 
//print "num rows: " . $totalRows . "\n<br />";	

$projectId = $audio_data['ProjectId'];

// if we specified a projectId on the URL then let's use that to prepopulate Project Id field
if (isset($_GET['ProjectId']) && $totalRows == 0) {
	$projectId = $_GET['ProjectId'];	
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

// Default to performing an upate unless we posted a action on the url then use that
$action = "Update";
$actionTitle = "Edit";
if (isset($_GET["action"])) {
	$action = $_GET["action"];
	$actionTitle = $_GET["action"];
} else if ($totalRows <= 0) {
	$action = "Add";
	$actionTitle = $action;
}

if (isset($_POST["MM_action"])) {
	
	if ($_POST["MM_action"] == "Add") {
			$sqlCommand = sprintf("INSERT INTO Audio SET ProjectId = %s, mp3Url = %s, oggUrl = %s, AudioLength = %s, Title = %s, Text = %s",
			 								 GetSQLValueString($_POST['ProjectId'], "int"),
                       GetSQLValueString($_POST['mp3'], "text"),
                       GetSQLValueString($_POST['ogg'], "text"),
                       GetSQLValueString($_POST['AudioLength'], "int"),
                       GetSQLValueString($_POST['Title'], "text"),
											 GetSQLValueString($_POST['Text'], "text"));
	//	print "sqlCommand: " . $sqlCommand;									 
/* To Do get the id of the record we just added											 
		$sqlComamand .= ";SELECT last_insert_id( );"; 									 
*/
	} else
  	$sqlCommand = sprintf("UPDATE Audio SET ProjectId=%s, mp3Url=%s, oggUrl=%s, AudioLength=%s, Title=%s, Text=%s WHERE Id=%s",
											 GetSQLValueString($_POST['ProjectId'], "int"),
                       GetSQLValueString($_POST['mp3'], "text"),
                       GetSQLValueString($_POST['ogg'], "text"),
                       GetSQLValueString($_POST['AudioLength'], "int"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Text'], "text"),
											 $audioId);

//  print "sqlCommand: " . $sqlCommand;
  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

  $updateGoTo = "ViewSlides.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Audio</title>
<style type="text/css">
/* BeginOAWidget_Instance_2921536: #OAWidget */

.blueLayer {
	height: 300px;
	width: 300px;
}

.layer {
	font-family: Helvetica Neue, Helvetica, nimbus-sans, Arial, "Lucida Grande", sans-serif;
	background-color: #eee;
	margin-right: auto;
	margin-left: auto;
	padding: 15px;
	border-color : #666;
	border-style: solid;
	border-width: 3px;
	opacity : 1;
	-moz-border-radius : 10px;
	-webkit-border-radius : 10px;
	border-radius : 10px;
	width: 800px;
	-moz-box-shadow: 3px 3px 5px 6px #ccc;
	-webkit-box-shadow: 5px 5px 5px 6px #ccc;
	box-shadow: 3px 3px 5px 6px #ccc;
}

body {
	font-family: Helvetica Neue, Helvetica, nimbus-sans, Arial, "Lucida Grande", sans-serif;
}

label {
	float: left;
	text-align: right;
	margin-top: 5px;
	margin-bottom: 5px;
	margin-right: 15px;
	padding-top: 5px;
	font-size: 1.2em;
	width : 120px;
	color:#555;
}

.descriptionText {	
	margin-top: 5px;
	margin-bottom: 5px;
	font-size: 1em;
	margin-top: 5px;
	margin-bottom: 5px;
}

.wideLabel {
		width: 305px;
}

input
{
	font-size: 1.2em; 
	padding: 5px; 
	border: 1px solid #b9bdc1;  
	color: #444;	
	margin-top:5px;
	margin-bottom:5px;
}
	
input:focus{
	background-color:LightYellow;
	color : #222;	
}
	
textarea {
	font-size: 1em;
	padding: 5px;
	height: 110px;
	color: #444;
	border: 1px solid #b9bdc1;
	margin-top: 5px;
	margin-bottom: 5px;
	width: 550px;
}

select {
	font-size:1.2em;
	margin-top : 5px;
	margin-bottom: 5px;
	border: 1px solid #b9bdc1;  
	color: #444;		
}

legend {
	font-size: 1.5em;
	text-align:center;
	color : #222;
}
.hint{
	display:none;
}
	
.field:hover .hint {  
	position: absolute;
	display: block;  
	margin: -30px 0 0 455px;
	color: #FFFFFF;
	padding: 7px 10px;
	background: rgba(0, 0, 0, 0.6);
	
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	}

.clearFloat {
	clear:both;
}

.verticalAlign {
	float : left;
}

.lineUp {
}

.imageDiv {
	margin-left: 10px;
	float: left;
}



.floatLeft {
	float : left;
}


</style>
<link href="_css/main.css" rel="stylesheet" type="text/css" />
<link href="jquery-ui-1.8.21/css/smoothness/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
<!--<link href="css/formStyle.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="js/utility.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

function updateThumbnailImage(object)
{
	var thumbnailURL = object.value;
	console.log('thumbnailURL: ' + thumbnailURL);	
	document.getElementById('thumbnailImage').src = thumbnailURL;
}

function deleteAudio()
{
	$("#Dialog").removeClass("noDisplay");
	$("#Dialog").dialog({
		height: 200,
		width: 300,
		modal: true
	});
}

function closeDialog()
{
	$("#Dialog").dialog('close');
}

tinyMCE.init({
        mode : "exact",
				elements : "Text",
				theme : "advanced",
					// Theme options
				theme_advanced_buttons1 : "bold,italic,underline",
				theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,charmap",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
			/*	theme_advanced_statusbar_location : "bottom",*/
				theme_advanced_resizing : true,
});
</script>
</head>

<body>
<?php include("HeaderNav.php") ?>

<div class="subNav"><a href="ViewProjects.php">View Projects</a> | <a href="ProjectDetails.php?Id=<?php echo $projectId; ?>">View Detail</a> | <a href="ViewSteps.php?ProjectId=<?php echo $projectId; ?>">View Steps</a> | <a href="ViewMedia.php">View Media</a> | <a href="EditMedia.php?action=Add"><img src="_images/icons/Plus16x16.gif" height="16" width="16" /> Add Media</a> |  <a href="ViewMedia.php">View Audio</a> | <a href="EditMedia.php?action=Add"><img src="_images/icons/Plus16x16.gif" height="16" width="16" /> Add Audio</a></div>
<div class="layer">
	<div class="subSubNav">
  <a href="ViewSlides.php<?php if ($projectId >= 0) echo "?ProjectId=" . $projectId; ?>">View Slides</a> </div>
	<form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
  <fieldset>
    <legend><?php echo $actionTitle; ?> Audio</legend>
   	<label for="Id">Id:</label>
    <input name="Id" type="text" id="Id" value="<?php echo $audio_data['Id']; ?>" size="5" readonly="readonly" />
    <div class="clearFloat"></div>
    <label for="ProjectId">ProjectId:</label>
      <input name="ProjectId" type="text" id="ProjectId" value="<?php echo $projectId; ?>" size="5" />
    <div class="clearFloat"></div>
    <label for="Title"> Title:</label>
    <input name="Title" type="text" class="wideLabel" id="Title" value="<?php echo $audio_data['Title']; ?>" />
    <div class="clearFloat"></div>
    
    <label for="Text">Text:</label>
		<textarea name="Text" type="text" id="Text"><?php echo $audio_data['Text']; ?></textarea>    
		<div class="clearFloat"></div>
    
   
    <div>

      <div class="verticalAlign">
        <label for="thumbnail">mp3 Url:</label>
        <input name="mp3" type="text" id="mp3" value="<?php echo $audio_data['mp3Url']; ?>" />
      </div>

      <div class="imageDiv"></div>
    </div>
    <div class="clearFloat"></div>
    <div class="lineUp">
        	<label for="TemplateName">ogg Url:</label>
          <input name="ogg" type="text" id="ogg" value="<?php echo $audio_data['oggUrl']; ?>" />
    </div>
    <div class="clearFloat"></div>
    <label for="AudioLength">Audio Length:</label>
    <input class="floatLeft" name="AudioLength" type="text" id="AudioLength" value="<?php echo $audio_data['AudioLength']; ?>" size="5" />
    <div class="clearFloat"></div>
  </fieldset>
  <div style="text-align:center">
    <input class="blueButton" type="submit" name="button" id="button" value="<?php echo $action; ?>" />
    &nbsp;<input class="redButton" type="button" name="deleteMediaButton" id="deleteMediaButton" value="Delete" onclick="deleteAudio()"/>
  </div>
  <input type="hidden" name="MM_action" value="<?php echo $action; ?>" />
	</form>
</div>
<div id="Dialog" class="noDisplay">
Delete this media?
<div id="spacerDiv" style="height:60px;"></div>
<div id="buttonContainer" style="text-align:center">
<input type="button" name="CancelDelete" id="CancelDelete" value="Cancel" onclick="closeDialog()"/>&nbsp;
<input class="redButton" type="button" name="deleteMediaButton" id="deleteMediaButton" value="Delete" onclick="goToURL('DeleteAudio.php?AudioId=<?php echo $audio_data['Id']; ?>')"/>
</div>
</div>
<div id="footer">
&copy;2012 Pearson Foundation
</div>
</body>
</html>
<?php
mysql_free_result($audioQuery);
?>
