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

if (isset($_POST["MM_action"])) {
	
	if ($_POST["MM_action"] == "Add") {
		$sqlCommand = sprintf("INSERT INTO Topics (Name, Tagline, SmallIcon, LargeIcon, DetailBadge, Banner, Featured, DisplayGalleryBadge, DisplayDetailBadge) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['tagline'], "text"),
                       GetSQLValueString($_POST['smallIcon'], "text"),
                       GetSQLValueString($_POST['largeIcon'], "text"),
                       GetSQLValueString($_POST['detailBadge'], "text"),
                       GetSQLValueString($_POST['banner'], "text"),
											 GetSQLValueString($_POST['featured'], "int"),
											 GetSQLValueString($_POST['displayGalleryBadge'], "int"),
											 GetSQLValueString($_POST['displayDetailBadge'], "int"));
	/*	
	  TO DO get row of last inserted record
		$insertId = last_insert_id( );
		print "Insert Id: $insertId\n";
		*/
	} else
  	$sqlCommand = sprintf("UPDATE Topics SET Name=%s, TagLine=%s, SmallIcon=%s, LargeIcon=%s, DetailBadge=%s, Banner=%s, Featured=%s, DisplayGalleryBadge=%s, DisplayDetailBadge=%s WHERE Id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['tagline'], "text"),
                       GetSQLValueString($_POST['smallIcon'], "text"),
                       GetSQLValueString($_POST['largeIcon'], "text"),
                       GetSQLValueString($_POST['detailBadge'], "text"),
                       GetSQLValueString($_POST['banner'], "text"),
											 GetSQLValueString($_POST['featured'], "int"),
											 GetSQLValueString($_POST['displayGalleryBadge'], "int"),
											 GetSQLValueString($_POST['displayDetailBadge'], "int"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

  $updateGoTo = "ViewTopics.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
} 


$colname_foundRecord = "-1";
if (isset($_GET['Id'])) {
  $colname_foundRecord = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_foundRecord = sprintf("SELECT * FROM Topics WHERE Id = %s", GetSQLValueString($colname_foundRecord, "int"));
$foundRecord = mysql_query($query_foundRecord, $projector) or die(mysql_error());
$row_foundRecord = mysql_fetch_assoc($foundRecord);
$totalRows_foundRecord = mysql_num_rows($foundRecord);
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Topic</title>
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
	width: 700px;
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
	font-size: 1.2em;
	padding: 5px;
	height: 80px;
	color: #444;
	border: 1px solid #b9bdc1;
	margin-top: 5px;
	margin-bottom: 5px;
	width: 500px;
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


		
.blueButton {
	background-color: #3AADEF;
	color:#FFF;
	padding-left:30px;
	padding-right:30px;
}

.redButton {
	color : #FFF;
	background-color: #C03;
	color:#FFF;
	padding-left:30px;
	padding-right:30px;
}


.bigWhiteButton {
	background-color: #FFF;
	color:#333;
	padding-left:30px;
	padding-right:30px;
}



</style>
<link href="_css/main.css" rel="stylesheet" type="text/css" />
<link href="jquery-ui-1.8.21/css/smoothness/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
<!--<link href="css/formStyle.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript">

function updateThumbnailImage(object,previewId)
{
	var thumbnailURL = object.value;
	console.log('thumbnailURL: ' + thumbnailURL);	
	document.getElementById(previewId).src = thumbnailURL;
}

function deleteTheProject(urlToGoTo)
{
	$("#Dialog").removeClass("noDisplay");
	$("#Dialog").dialog({
		height: 200,
		width: 400,
		modal: true
	});
}

function closeDialog()
{
	$("#Dialog").dialog('close');
}

</script>
</head>

<body>
<?php $selectedNav = "NavGallery"; ?>
<?php include("HeaderNav.php") ?>
<div class="subNav"><a href="ViewProjects.php">View Projects</a> | <a href="EditProject.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Project</a> | <a href="ViewRoutines.php">View Routines</a> |<span class="subSubNav"><a href="ViewMedia.php">View Media</a></span></div>
<div class="layer">
	<form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
  <div class="subSubNav"><a href="ViewTopics.php">View Topics</a></div>
  <fieldset>
    <legend><?php echo $actionTitle; ?> Topic</legend>
   <label for="smallIcon">Id:</label>
      <input name="Id" type="text" id="Id" value="<?php echo $row_foundRecord['Id']; ?>" size="5" readonly="readonly" />
    <div class="clearFloat"></div>
      <label for="name">Featured:</label>
      <input <?php if (!(strcmp($row_foundRecord['Featured'],1))) {echo "checked=\"checked\"";} ?> name="featured" type="checkbox" id="featured" value="1" />
      <div class="clearFloat"></div>
    <label for="name">Name:</label>
    <input name="name" type="text" class="wideLabel" id="name" placeholder="Project Name" value="<?php echo $row_foundRecord['Name']; ?>" />
    <div class="clearFloat"></div>
    <label for="tagline">Tag Line:</label>
    <textarea name="tagline" id="tagline"><?php echo $row_foundRecord['TagLine']; ?></textarea>    
    <div class="clearFloat"></div>   
    <div>
    	<div class="verticalAlign">
      <label for="thumbnail">Small Icon:</label>
      <input name="smallIcon" type="text" id="smallIcon" value="<?php echo $row_foundRecord['SmallIcon']; ?>" onblur="updateThumbnailImage(this,'smallIconImage')"/>
      
    	</div>
      <div class="imageDiv">
    		<img src="<?php echo $row_foundRecord['SmallIcon']; ?>" alt="" name="smallIconImage" width="45" height="45" id="smallIconImage" />
    	</div>
      &nbsp;Display&nbsp;
      <input <?php if (!(strcmp($row_foundRecord['DisplayGalleryBadge'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="displayGalleryBadge" id="displayGalleryBadge" value="1"/>
    </div>
    
    <div class="clearFloat"></div>
    <div>
    	<div class="verticalAlign">
      <label for="largeIcon">Large Icon:</label>
      <input name="largeIcon" type="text" id="largeIcon" value="<?php echo $row_foundRecord['LargeIcon']; ?>" onblur="updateThumbnailImage(this,'largeImage')"/>
    	</div>
      <div class="imageDiv">
    		<img src="<?php echo $row_foundRecord['LargeIcon']; ?>" alt="" name="largeImage" width="80" height="80" id="largeImage" />
    	</div>&nbsp;Display&nbsp;
      <input <?php if (!(strcmp($row_foundRecord['DisplayDetailBadge'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="displayDetailBadge" id="displayDetailBadge" value="1"/>
    </div>
    <div class="clearFloat"></div>
    <div>
    	<div class="verticalAlign">
      <label for="detailBadge">Detail Badge:</label>
      <input name="detailBadge" type="text" id="detailBadge" value="<?php echo $row_foundRecord['DetailBadge']; ?>" onblur="updateThumbnailImage(this,'detailImage')"/>
    	</div>
      <div class="imageDiv">
    		<img src="<?php echo $row_foundRecord['DetailBadge']; ?>" alt="" name="detailImage" width="120" height="80" id="detailImage" />
    	</div>
    </div>
    <div class="clearFloat"></div>
    <div>
    	<div class="verticalAlign">
      <label for="detailBadge">Banner:</label>
      <input name="banner" type="text" id="banner" value="<?php echo $row_foundRecord['Banner']; ?>" onblur="updateThumbnailImage(this,'Banner')"/>
    	</div>
      <div class="imageDiv">
    		<img src="<?php echo $row_foundRecord['Banner']; ?>" alt="" name="mediumImage" width="140" height="40" id="mediumImage" />
    	</div>
    </div>
    <div class="clearFloat"></div>
  </fieldset>
  <div style="text-align:center">
    <input class="blueButton" type="submit" name="button" id="button" value="<?php echo $action; ?>" />&nbsp;
    <input class="redButton" type="button" name="deleteProject2" id="deleteProject2" value="Delete" onclick="deleteTheProject()"/>
<script type="text/javascript" src="js/utility.js"></script>
  </div>
  <input type="hidden" name="MM_action" value="<?php echo $action; ?>" />
	</form>
</div>
<div id="Dialog" class="noDisplay">
Delete the project: <br />
<strong><?php echo $row_foundRecord['Name']; ?></strong><br />
<div id="dialogSpacer" style="height:40px;"></div>
<div id="buttonContainer" style="text-align:center">
<input type="button" name="CancelDelete" id="CancelDelete" value="Cancel" onclick="closeDialog()"/>
<input class="redButton" type="button" name="deleteProject" id="deleteProject" value="Delete" onclick="goToURL('DeleteProject.php?Id=<?php echo $row_foundRecord['Id']; ?>')"/>
</div>
</div>
<div id="footer">
&copy;2012 Pearson Foundation
</div>
</body>
</html>
<?php
mysql_free_result($foundRecord);
?>
