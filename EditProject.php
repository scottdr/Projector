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
		$sqlCommand = sprintf("INSERT INTO projects (Name, Subject, GradeMin, GradeMax, Duration, `Description`, Author, ImgSmall, ImgMedium, ImgLarge, Status, Topic) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['gradeMin'], "int"),
                       GetSQLValueString($_POST['gradeMax'], "int"),
                       GetSQLValueString($_POST['duration'], "int"),
                       GetSQLValueString($_POST['description'], "text"),
											 GetSQLValueString($_POST['author'], "text"),
											 GetSQLValueString($_POST['Thumbnail'], "text"),
											 GetSQLValueString($_POST['mediumImageInput'], "text"),
											 GetSQLValueString($_POST['largeImageInput'], "text"),
											 GetSQLValueString($_POST['status'], "text"),
											 GetSQLValueString($_POST['topic'], "int"));
	/*	
	  TO DO get row of last inserted record
		$insertId = last_insert_id( );
		print "Insert Id: $insertId\n";
		*/
	} else
  	$sqlCommand = sprintf("UPDATE projects SET Name=%s, Subject=%s, ImgSmall=%s, ImgMedium=%s, ImgLarge=%s, GradeMin=%s, GradeMax=%s, Duration=%s, Author=%s, `Description`=%s, Status=%s, Topic=%s WHERE Id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['Thumbnail'], "text"),
											 GetSQLValueString($_POST['mediumImageInput'], "text"),
											 GetSQLValueString($_POST['largeImageInput'], "text"),
                       GetSQLValueString($_POST['gradeMin'], "int"),
                       GetSQLValueString($_POST['gradeMax'], "int"),
                       GetSQLValueString($_POST['duration'], "int"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
											 GetSQLValueString($_POST['status'], "text"),
											 GetSQLValueString($_POST['topic'], "int"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

  $updateGoTo = "ViewProjects.php";
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

// Query for the Topics Menu
mysql_select_db($database_projector, $projector);
$query_TopicsMenu = "SELECT Id, Name FROM Topics";
$TopicsMenu = mysql_query($query_TopicsMenu, $projector) or die(mysql_error());
$row_TopicsMenu = mysql_fetch_assoc($TopicsMenu);
$totalRows_TopicsMenu = mysql_num_rows($TopicsMenu);
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
<div class="subNav"><a href="ViewProjects.php">View Projects</a> | <a href="ProjectDetails.php?Id=<?php echo $row_foundRecord['Id']; ?>">View Project</a> | <a href="EditProject.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Project</a> | <a href="ViewRoutines.php">View Routines</a> | <a href="ViewTopics.php">Topics</a></div>
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
        <option value="Edit" <?php if ($row_foundRecord['Status'] == "Edit") echo 'selected="selected" '?> >Edit</option>
        <option value="Review" <?php if ($row_foundRecord['Status'] == "Review") echo 'selected="selected"'?> >Review</option>
        <option value="Pilot" <?php if ($row_foundRecord['Status'] == "Pilot") echo 'selected="selected"'?> >Live</option> 
        <option value="Published" <?php if ($row_foundRecord['Status'] == "Published") echo 'selected="selected"'?> >Published</option>
      </select>
    </div>
    <div class="clearFloat"></div>
    
    <div class="lineUp">
     	<label for="topic">Topic:</label>
        <select name="topic" id="topic">
          <?php
					do {  
					?>
					<option value="<?php echo $row_TopicsMenu['Id']?>"<?php if (!(strcmp($row_TopicsMenu['Id'], $row_foundRecord['Topic']))) {echo "selected=\"selected\"";} ?>><?php echo $row_TopicsMenu['Name']?></option>
					<?php
					} while ($row_TopicsMenu = mysql_fetch_assoc($TopicsMenu));
						$rows = mysql_num_rows($TopicsMenu);
						if($rows > 0) {
								mysql_data_seek($TopicsMenu, 0);
							$row_TopicsMenu = mysql_fetch_assoc($TopicsMenu);
						}
					?>
        </select>
    </div>
    <div class="clearFloat"></div>
     
    <div>
    	<div class="verticalAlign">
      <label for="thumbnail">Small Image:</label>
      <input name="Thumbnail" type="text" id="Thumbnail" value="<?php echo $row_foundRecord['ImgSmall']; ?>" onblur="updateThumbnailImage(this,'thumbnailImage')"/>
    	</div>
      <div class="imageDiv">
    		<img src="<?php echo $row_foundRecord['ImgSmall']; ?>" alt="" name="thumbnailImage" width="120" height="80" id="thumbnailImage" />
    	</div>
    </div>
    
    <div class="clearFloat"></div>
    <div>
    	<div class="verticalAlign">
      <label for="mediumImageInput">Medium Img:</label>
      <input name="mediumImageInput" type="text" id="mediumImageInput" value="<?php echo $row_foundRecord['ImgMedium']; ?>" onblur="updateThumbnailImage(this,'mediumImage')"/>
    	</div>
      <div class="imageDiv">
    		<img src="<?php echo $row_foundRecord['ImgMedium']; ?>" alt="" name="mediumImage" width="120" height="80" id="mediumImage" />
    	</div>
    </div>
    <div class="clearFloat"></div>
      <div>
    	<div class="verticalAlign">
      <label for="largeImageInput">Large Image:</label>
      <input name="largeImageInput" type="text" id="largeImageInput" value="<?php echo $row_foundRecord['ImgLarge']; ?>" onblur="updateThumbnailImage(this,'largeImage')"/>
    	</div>
      <div class="imageDiv">
    		<img src="<?php echo $row_foundRecord['ImgLarge']; ?>" alt="" name="largeImage" width="120" height="80" id="largeImage" />
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
mysql_free_result($TopicsMenu);
?>

