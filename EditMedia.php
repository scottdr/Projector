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

$mediaId = "-1";
if (isset($_GET['Id'])) {
  $mediaId = $_GET['Id'];
}

// always do the query it will clear out $media_steps if the media object does not already exist
mysql_select_db($database_projector, $projector);
$query_media = "SELECT * FROM Media WHERE Id = " . $mediaId;
$media = mysql_query($query_media, $projector) or die(mysql_error());
$media_steps = mysql_fetch_assoc($media);
$mediaId = $media_steps['Id'];
$projectId = $media_steps['ProjectId'];
$totalRows_steps = mysql_num_rows($media); 

// if we specified a projectId on the URL then let's use that to prepopulate Project Id field
if (isset($_GET['ProjectId']) && $totalRows_steps == 0) {
	$projectId = $_GET['ProjectId'];	
}

//print "_SERVER['PHP_SELF'] = " . $_SERVER['PHP_SELF']; 

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
			$sqlCommand = sprintf("INSERT INTO Media SET ProjectId = %s, Caption = %s, Description = %s, Type = %s, Url = %s, Width = %s, Height = %s",
			 								 GetSQLValueString($_POST['ProjectId'], "int"),
                       GetSQLValueString($_POST['Caption'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Type'], "text"),
                       GetSQLValueString($_POST['Url'], "text"),
											 GetSQLValueString($_POST['Width'], "int"),
											 GetSQLValueString($_POST['Height'], "int"));
		print "sqlCommand: " . $sqlCommand;									 
/* To Do get the id of the record we just added											 
		$sqlComamand .= ";SELECT last_insert_id( );"; 									 
*/
	} else
  	$sqlCommand = sprintf("UPDATE Media SET ProjectId=%s, Caption=%s, Description=%s, Type=%s, Url=%s, Width=%s, Height=%s WHERE Id=%s",
											 GetSQLValueString($_POST['ProjectId'], "int"),
                       GetSQLValueString($_POST['Caption'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Type'], "text"),
                       GetSQLValueString($_POST['Url'], "text"),
                       GetSQLValueString($_POST['Width'], "int"),
                       GetSQLValueString($_POST['Height'], "int"),
                       GetSQLValueString($_POST['Id'], "int"));

	//print "sqlCommand: " . $sqlCommand;
  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

  $updateGoTo = "ViewMedia.php";
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
<title>Edit Media</title>
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

.floatLeft {
	float : left;
}


</style>
<link href="_css/main.css" rel="stylesheet" type="text/css" />
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
<div class="subNav"><a href="ViewProjects.php">Display Projects</a> | <a href="Gallery.php">Tile Grid</a> | <a href="ViewSteps.php?ProjectId=<?php echo $projectId; ?>">View Steps</a> | <a href="ViewMedia.php">View Media</a> | <a href="EditMedia.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Media</a></div>
<div class="layer">
	<form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
  <fieldset>
    <legend><?php echo $actionTitle; ?> Media</legend>
   <label for="Media1Url">Id:</label>
      <input name="Id" type="text" id="Id" value="<?php echo $media_steps['Id']; ?>" size="5" readonly="readonly" />
    <div class="clearFloat"></div>
		<label for="ProjectId">ProjectId:</label>
      <input name="ProjectId" type="text" id="ProjectId" value="<?php echo $projectId; ?>" size="5" />
    <div class="clearFloat"></div>
    <label for="Caption"> Caption:</label>
    <input name="Caption" type="text" class="wideLabel" id="Caption" value="<?php echo $media_steps['Caption']; ?>" />
    <div class="clearFloat"></div>
    
    <label for="Description">Description:</label>
		<textarea name="Description" type="text" id="Description"><?php echo $media_steps['Description']; ?></textarea>    
		<div class="clearFloat"></div>
    
   
    <div>

      <div class="verticalAlign">
        <label for="thumbnail">Url:</label>
        <input name="Url" type="text" id="Url" value="<?php echo $media_steps['Url']; ?>" onblur="updateThumbnailImage(this)"/>
      </div>

      <div class="imageDiv">
    		<img src="<?php echo $media_steps['Url']; ?>" alt="" name="thumbnailImage" id="thumbnailImage" width="120" height="90" />
    	</div>
    </div>
    <div class="clearFloat"></div>
    <div class="lineUp">
        	<label for="TemplateName">Type:</label>
      <select name="Type" id="Type" value="<?php echo $media_steps['Type']; ?>">
        <option selected="selected">Image</option>
        <option>Movie</option>
        <option>Audio</option>
      </select>
   
    </div>
    <div class="clearFloat"></div>
    <label for="Width">Width:</label>
    <input class="floatLeft" name="Width" type="text" id="Width" value="<?php echo $media_steps['Width']; ?>" size="5" />
    <label class="floatLeft" for="Height">Height:</label>
    <input class="floatLeft" name="Height" type="text" id="Height" value="<?php echo $media_steps['Height']; ?>" size="5" />
    <div class="clearFloat"></div>
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
</body>
</html>
<?php
mysql_free_result($media);
?>
