<?php require_once('Connections/projector.php'); ?>
<?php require_once('Globals.php'); ?>
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

$projectId = "-1";
if (isset($_GET['ProjectId'])) {
  $projectId = $_GET['ProjectId'];
}
mysql_select_db($database_projector, $projector);
$query_SlideRecordset = sprintf("SELECT * FROM Slides WHERE ProjectId = %s", GetSQLValueString($projectId, "int"));
$SlideRecordset = mysql_query($query_SlideRecordset, $projector) or die(mysql_error());
$row_SlideRecordset = mysql_fetch_assoc($SlideRecordset);
$totalRows_SlideRecordset = mysql_num_rows($SlideRecordset);

function GetMediaForSlide($SlideId) {
	global $database_projector, $projector;
	
	mysql_select_db($database_projector, $projector);
	$sqlStatement = "SELECT Media.Id, Media.Caption, Media.Url FROM Media, SlideAttach WHERE SlideAttach.MediaId = Media.Id AND SlideAttach.SlideId = " . $SlideId;
	$media = mysql_query($sqlStatement, $projector) or die(mysql_error());
	$media_steps = mysql_fetch_assoc($media);
	$media_count = mysql_num_rows($media);
	if ($media_count > 0) {
		do {
			print '<img name="Id=' . $media_steps['Id'] . '" src="' . $media_steps['Url'] . '" width="100" height="80" alt="' . $media_steps['Caption'] . '">';
		} while ($media_steps = mysql_fetch_assoc($media));
	}
	mysql_free_result($media);
}

session_start();
if (isset($_GET['ProjectName'])) {
  $projectName = $_GET['ProjectName'];
} else if (isset($_SESSION['ProjectName'])) {
	$projectName = $_SESSION['ProjectName'];
} else
	$projectName = 'None';

$_SESSION['ProjectName'] = $projectName;
	
if (isset($_SESSION['ProjectUrl'])) {
	$projectUrl = $_SESSION['ProjectUrl'];
}	

if (isset($_SESSION['ProjectImage'])) {
	$projectImage = $_SESSION['ProjectImage'];
}	


if ($PROJECTOR['cc'])
	$challengeTemplateURL = "OC_CCSoC_ChallengeTemplate.php";
else
	$challengeTemplateURL = "ChallengeTemplate.php";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>View Slides</title>
<script type="text/javascript" src="js/utility.js"></script>
<link href="_css/main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.description {
	font-size: .8em;
}

.projectItem{
}

.projectItem:Hover{
	background-color:LightYellow;
}


table {
		border:1px solid #666;
		border-collapse:collapse;
}

th{
	background-color: #ccc;
	border-collapse: collapse;
	padding: 5px;
	text-align: left;
	border-bottom-width: thin;
	border-bottom-color: #666;
	border-bottom-style: solid;
}	

td{
		border-collapse:collapse;
		padding:5px;
}

#content {
	margin-left:auto;
	margin-right:auto;
	width:940px;
	padding:20px;
}

h3 {
	text-align:center;
}
#projectImage {
	margin-left:20px;
}

.rowItem:Hover{
	background-color:LightYellow;
}

.clearFloat {
	clear:both;
}
#content #StepList {
	margin-right: auto;
	margin-left: auto;
}

/* For the Title column if the title is too long shorten it to 200px and add ellipsis */
.ellipsis {
	white-space: nowrap;
	width: 200px;
	overflow: hidden;
	text-overflow: ellipsis;
}

.titleColumn {
	width:200px;
}

</style>
<script type="text/javascript">
window.onload = function() 
{ 
	var form = document.forms["stepForm"]; 
	listenEvent(form,"submit", validateFields); 
} 

function validateFields(evt) 
{
	var form = document.forms["stepForm"];
	form.getAttribute("action"); 	
	evt = evt ? evt : window.event;
}
	


</script>
</head>

<body>
<?php include("HeaderNav.php") ?>
<div class="subNav"><a href="ViewProjects.php">View Projects</a> | <a href="ViewMedia.php">View Media</a> | <a href="EditMedia.php?action=Add"><img src="_images/icons/Plus16x16.gif" height="16" width="16" /> Add Media</a> | <a href="ViewTopics.php">Topics</a></div>
<?php if ($totalRows_SlideRecordset > 0): ?>
<div id="content">
<div class="subSubNav"><a href="EditAudio.php?ProjectId=<?php echo $projectId; ?>">Edit Audio</a> | <a href="EditSlide.php?action=Add&ProjectId=<?php echo $projectId; ?>"><img src="_images/icons/Plus16x16.gif" height="16" width="16" />Add Slide</a> | <a href="SlideShowJSON.php?ProjectId=<?php echo $projectId; ?>">JSON Data</a> | <a href="<?php echo $challengeTemplateURL; ?>?ProjectId=<?php echo $projectId; ?>">View Challenge</a></div>
<h3>View Slides Project # <?php echo $projectId; ?></h3>
<table id="StepList" width="600" class="clearFloat">
  <tr>
    <th>Id</th>
    <th>Order</th>
    <th>Title</th>
    <th>Template</th>
    <th>Media</th>
  </tr>
  <?php do { ?>
    <tr class="rowItem">
      <td><form id="stepForm" name="form1" method="get" action="EditSlide.php">
        <input style="background-image: url(_images/icons/Pencil26x26.gif); width:26px;" class="button" type="submit" name="button" id="button" value="Edit" />
        <input name="Id" type="hidden" id="Id" value="<?php echo $row_SlideRecordset['Id']; ?>" />
      </form>
			</td>
      <td><?php echo $row_SlideRecordset['SortOrder']; ?></td>
      <td class="titleColumn" nowrap="nowrap"><?php echo $row_SlideRecordset['Title']; ?>        <div class="ellipsis"></div></td>
      <td><?php echo $row_SlideRecordset['TemplateName']; ?></td>
      <td><?php GetMediaForSlide($row_SlideRecordset['Id']); ?></td>
    </tr>
    <?php } while ($row_SlideRecordset = mysql_fetch_assoc($SlideRecordset)); ?>
</table>
</div>
<?php else: ?>
<div id="errorMessage">
<p>There are no slides defined for this project.<br />
Click the Add Slides button to create a slide.</p>
<p><input id="editButton" class="button" style="background-image: url(_images/icons/Pencil26x26.gif); background-size: 26px 26px;" name="action" type="button" value="Add Slide" onclick="goToURL('EditSlide.php?action=Add&ProjectId=<?php echo $projectId; ?>')" />
</p>
</div>
<?php endif; ?>
</body>
</html>
<?php
mysql_free_result($SlideRecordset);
?>
