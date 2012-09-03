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

$stepId = "-1";
if (isset($_GET['Id'])) {
  $stepId = $_GET['Id'];
}
$ProjectName = "";

if (isset($_SESSION['ProjectName']))
	$ProjectName = $_SESSION['ProjectName'];

mysql_select_db($database_projector, $projector);
$query_steps = "SELECT * FROM Steps WHERE Id = " . $stepId;
$steps = mysql_query($query_steps, $projector) or die(mysql_error());
$row_steps = mysql_fetch_assoc($steps);
$projectId = $row_steps['ProjectId'];
$totalRows_steps = mysql_num_rows($steps);

session_start();
$_SESSION['ProjectId'] = $projectId;
$_SESSION['StepId'] = $row_steps['Id'];

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
}

if (isset($_GET["ProjectId"])) {
	$projectId = $_GET["ProjectId"];
}


if (isset($_POST["MM_action"])) {
	
	if ($_POST["MM_action"] == "Add") {
			$sqlCommand = sprintf("INSERT INTO Steps SET ProjectId = %s, SortOrder = %s, RoutineId = %s, LessonName = %s, Title = %s, Type = %s, TemplateName = %s, Text = %s",
                       GetSQLValueString($_POST['ProjectId'], "int"),
                       GetSQLValueString($_POST['SortOrder'], "int"),
											 GetSQLValueString($_POST['RoutineId'], "int"),
                       GetSQLValueString($_POST['LessonName'], "text"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Type'], "text"),
                       GetSQLValueString($_POST['TemplateName'], "text"),
											 GetSQLValueString($_POST['Text'], "text"));
//		print "sqlCommand: " . $sqlCommand;									 
/* To Do get the id of the record we just added											 
		$sqlComamand .= ";SELECT last_insert_id( );"; 									 
*/
	} else
  	$sqlCommand = sprintf("UPDATE Steps SET ProjectId=%s, SortOrder=%s, RoutineId = %s, LessonName=%s, Title=%s, Type=%s, TemplateName=%s, `Text`=%s WHERE Id=%s",
                       GetSQLValueString($_POST['ProjectId'], "int"),
                       GetSQLValueString($_POST['SortOrder'], "int"),
											 GetSQLValueString($_POST['RoutineId'], "int"),
                       GetSQLValueString($_POST['LessonName'], "text"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Type'], "text"),
                       GetSQLValueString($_POST['TemplateName'], "text"),
											 GetSQLValueString($_POST['Text'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

//	print "sqlCommand: " . $sqlCommand;
  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

  $updateGoTo = "ViewSteps.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
	$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
	$updateGoTo .= "ProjectId=" . $projectId; 
  header(sprintf("Location: %s", $updateGoTo));
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Project</title>
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript">

function attachMedia()
{
	$.ajax({
  	url: "sql/MediaData.php",
  	cache: false
	}).done(function( html ) {
		$("#Dialog").removeClass("hideMe");
  	$("#Dialog").append(html);
		$( "#Dialog" ).dialog({
			height: 600,
			width: 550,
			modal: true
		});
	});
}

</script>
<style type="text/css">
/* BeginOAWidget_Instance_2921536: #OAWidget */

.blueLayer {
	height: 300px;
	width: 300px;
}

.layer {
	font-family: Arial, Verdana, sans-serif;
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
	font-family: Arial, Verdana, sans-serif;
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


		
/* EndOAWidget_Instance_2921536 */
.blueButton {
	background-color: #3AADEF;
	color:#FFF;
	padding-left:30px;
	padding-right:30px;
}

.hideMe {
	visibility:hidden;
}
</style>
<link href="_css/main.css" rel="stylesheet" type="text/css" />
<link href="jquery-ui-1.8.21/css/smoothness/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
<!--<link href="css/formStyle.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript">

function updateThumbnailImage(object)
{
	var thumbnailURL = object.value;
	console.log('thumbnailURL: ' + thumbnailURL);	
	document.getElementById('thumbnailImage').src = thumbnailURL;
}
</script>
</head>

<body>
<?php include("HeaderNav.php") ?>
<div class="subNav"><a href="ViewProjects.php">Display Projects</a> | <a href="Gallery.php">Tile Grid</a> | <a href="ViewSteps.php?ProjectId=<?php echo $projectId; ?>">View Steps</a> | <a href="EditStep.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Step</a> | <a href="ViewMedia.php">View Media</a> | <a href="EditMedia.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Media</a> | <a href="ChallengeTemplate.php?ProjectId=<?php echo $projectId; ?>&StepId=<?php echo $stepId; ?>">View Challenge</a></div></div>
<div class="layer">
	<form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
  <fieldset>
    <legend><?php echo $actionTitle; ?> Step</legend>
    <label for="Id">Id:</label>
    <input name="Id" type="text" id="Id" value="<?php echo $row_steps['Id']; ?>" size="5" readonly="readonly" />
    <div class="clearFloat"></div>
    <label for="ProjectId">ProjectId:</label>
    <input name="ProjectId" type="text" id="ProjectId" placeholder="Project Name" value="<?php echo $projectId; ?>" size="5" /> <?php echo $ProjectName; ?>
    <div class="clearFloat"></div>
    <label for="LessonName"> Name:</label>
    <input name="LessonName" type="text" class="wideLabel" id="LessonName" value="<?php echo $row_steps['LessonName']; ?>" />
    <div class="clearFloat"></div>
    <label for="Title">Title:</label>
    <input name="Title" type="text" class="wideLabel" id="Title" value="<?php echo $row_steps['Title']; ?>" />
    
    <div class="clearFloat"></div>
    <label for="grade">Order:</label>
    <input name="SortOrder" type="text" id="grade" value="<?php echo $row_steps['SortOrder']; ?>" size="5" />
    <div class="clearFloat"></div>
    <label for="RoutineId">Routine:</label>
    <?php require("RoutineMenu.php") ?>
    <div class="clearFloat"></div>
    <label for="Text">Text:</label>
    <textarea name="Text" id="Text"><?php echo $row_steps['Text']; ?></textarea>
    <div class="clearFloat"></div>
    <div class="lineUp">
     	<label for="Type">Type:</label>
      <select name="Type" id="Type" value="<?php echo $row_steps['Type']; ?>">
        <option value="0" selected="selected">Generic</option>
        <option value="1">Individual</option>
      </select>
    </div>
    <div class="clearFloat"></div>
     <div class="lineUp">
     	<label for="TemplateName">Template:</label>
      <select name="TemplateName" id="TemplateName" value="<?php echo $row_steps['TemplateName']; ?>">
        <option value="MediaLeft.php" <?php if ($row_steps['TemplateName'] == "MediaLeft.php") echo ' selected="selected" '; ?>>Media Left</option>
        <option value="Plan.php" <?php if ($row_steps['TemplateName'] == "Plan.php") echo ' selected="selected" '; ?>>Plan</option>
        <option value="Research.php" <?php if ($row_steps['TemplateName'] == "Research.php") echo ' selected="selected" '; ?>>Research</option>
        <option value="Create.php" <?php if ($row_steps['TemplateName'] == "Create.php") echo ' selected="selected" '; ?>>Create</option>
        <option value="Revise.php" <?php if ($row_steps['TemplateName'] == "Revise.php") echo ' selected="selected" '; ?>>Revise</option>
        <option value="Present.php" <?php if ($row_steps['TemplateName'] == "Present.php") echo ' selected="selected" '; ?>>Present</option>
      </select>
    </div>
    <div class="clearFloat"></div>
    <?php if ($action == "Update"): ?>
    <div>
    	<label for="thumbnail">Media:</label>
      <div class="imageDiv">
      	<?php if ($action == "Update") include("AttachedMediaQuery.php"); ?>
    	</div>
    </div>
    <div class="clearFloat"></div>
    <div style="text-align:center">    	
    	<input class="blueButton" type="button" name="button" id="button" value="Attach Media" onclick="attachMedia()" />
    </div>
    <?php endif; ?>
  </fieldset>
  <div style="text-align:center">
    <input class="blueButton" type="submit" name="button" id="button" value="<?php echo $action; ?>" />
  </div>
  <input type="hidden" name="MM_action" value="<?php echo $action; ?>" />
	</form>
</div>
<div id="footer">
&copy;2012 Pearson Foundation
</div>
<!-- this is used for displaying a dialog with the media to be attached -->
<div id="Dialog" class="hideMe">
Select the media to be attached:
</div>
</body>
</html>
<?php
mysql_free_result($steps);
?>
