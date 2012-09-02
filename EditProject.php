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
		$sqlCommand = sprintf("INSERT INTO projects (Name, Subject, GradeMin, GradeMax, Duration, `Description`, Author, ImgSmall) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['gradeMin'], "int"),
                       GetSQLValueString($_POST['gradeMax'], "int"),
                       GetSQLValueString($_POST['duration'], "int"),
                       GetSQLValueString($_POST['description'], "text"),
											 GetSQLValueString($_POST['author'], "text"),
											 GetSQLValueString($_POST['Thumbnail'], "text"));
	/*	
	  TO DO get row of last inserted record
		$insertId = last_insert_id( );
		print "Insert Id: $insertId\n";
		*/
	} else
  	$sqlCommand = sprintf("UPDATE projects SET Name=%s, Subject=%s, ImgSmall=%s, GradeMin=%s, GradeMax=%s, Duration=%s, Author=%s, `Description`=%s WHERE Id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['Thumbnail'], "text"),
                       GetSQLValueString($_POST['gradeMin'], "int"),
                       GetSQLValueString($_POST['gradeMax'], "int"),
                       GetSQLValueString($_POST['duration'], "int"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

  $updateGoTo = "DisplayProjectsTable.php";
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
$query_foundRecord = sprintf("SELECT * FROM projects WHERE Id = %s", GetSQLValueString($colname_foundRecord, "int"));
$foundRecord = mysql_query($query_foundRecord, $projector) or die(mysql_error());
$row_foundRecord = mysql_fetch_assoc($foundRecord);
$totalRows_foundRecord = mysql_num_rows($foundRecord);
session_start();
$_SESSION['ProjectName'] = $row_foundRecord['Name'];
$_SESSION['ProjectImage'] = $row_foundRecord['ImgSmall'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Project</title>
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
	width: 550px;
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
	height:110px;	 
	color: #444;	
	border: 1px solid #b9bdc1; 
	margin-top:5px;
	margin-bottom:5px;
	width:305px; 
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
<div class="subNav"><a href="ViewProjects.php">Display Projects</a> | <a href="Gallery.php">Tile Grid</a> | <a href="ProjectDetails.php?Id=<?php echo $row_foundRecord['Id']; ?>">View Project</a> | <a href="EditProject.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Project</a> | <a href="ViewRoutines.php">View Routines</a></div>
<div class="layer">
	<form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
  <div class="subSubNav"><a href="EditDetails.php?ProjectId=<?php echo $row_foundRecord['Id']; ?>"><img src="icons/Writing.16x16.png" width="16" height="16" alt="Edit Details" /> Edit Details</a> | <a href="ViewSteps.php?ProjectId=<?php echo $row_foundRecord['Id']; ?>">View Steps</a> | <a href="EditStep.php?action=Add&ProjectId=<?php echo $row_foundRecord['Id']; ?>"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Step</a> | <a href="ViewMedia.php?ProjectId=<?php echo $row_foundRecord['Id']; ?>">View Media</a> | <a href="EditMedia.php?action=Add&ProjectId=<?php echo $row_foundRecord['Id']; ?>"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Media</a></div>
  <fieldset>
    <legend><?php echo $actionTitle; ?> Project</legend>
   <label for="Thumbnail">Id:</label>
      <input name="Id" type="text" id="Id" value="<?php echo $row_foundRecord['Id']; ?>" size="5" readonly="readonly" />
    <div class="clearFloat"></div>
    <label for="name">Name:</label>
    <input name="name" type="text" class="wideLabel" id="name" placeholder="Project Name" value="<?php echo $row_foundRecord['Name']; ?>" />
    <div class="clearFloat"></div>
    <label for="author">Author:</label>
    <input name="author" type="text" class="wideLabel" id="author" value="<?php echo $row_foundRecord['Author']; ?>" />
    <div class="clearFloat"></div>
    <label for="subject">Subject:</label>
    <input name="subject" type="text" class="wideLabel" id="subject" value="<?php echo $row_foundRecord['Subject']; ?>" />
    
    <div class="clearFloat"></div>
    <label for="grade">Grade:</label>
    <input name="gradeMin" type="text" id="grade" value="<?php echo $row_foundRecord['GradeMin']; ?>" size="5" />
    Min
    
      <input name="gradeMax" type="text" id="gradeMax" value="<?php echo $row_foundRecord['GradeMax']; ?>" size="5" />
    Max
    </label>
<div class="clearFloat"></div>
    <label for="duration">Duration:</label>
	<input name="duration" type="text" id="duration" value="<?php echo $row_foundRecord['Duration']; ?>" size="5" />
    <span class="descriptionText">Days</span>
		<div class="clearFloat"></div>
    <label for="description">Description:</label>
    <textarea name="description" id="description"><?php echo $row_foundRecord['Description']; ?></textarea>
    <div class="clearFloat"></div>
    <div class="lineUp">
     	<label for="status">Status:</label>
      <select name="status" id="status">
        <option value="0">Edit</option>
        <option value="1">Review</option>
        <option value="2" selected="selected">Live</option>
      </select>
    </div>
    <div class="clearFloat"></div>
     
    <div>
    	<div class="verticalAlign">
      <label for="thumbnail">Image:</label>
      <input name="Thumbnail" type="text" id="Thumbnail" value="<?php echo $row_foundRecord['ImgSmall']; ?>" onblur="updateThumbnailImage(this)"/>
    	</div>
      <div class="imageDiv">
    		<img src="<?php echo $row_foundRecord['ImgSmall']; ?>" alt="" name="thumbnailImage" width="120" height="80" id="thumbnailImage" />
    	</div>
    </div>
    
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
mysql_free_result($foundRecord);
?>
