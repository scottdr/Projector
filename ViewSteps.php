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

function GetMediaForStep($StepId) {
	global $database_projector, $projector;
	
	mysql_select_db($database_projector, $projector);
	$sqlStatement = "SELECT Media.Id, Media.Caption, Media.Url FROM Media, MediaAttach WHERE MediaAttach.MediaId = Media.Id AND MediaAttach.StepId = " . $StepId;
	$media = mysql_query($sqlStatement, $projector) or die(mysql_error());
	$media_steps = mysql_fetch_assoc($media);
	do {
		print '<img name="Id=' . $media_steps['Id'] . '" src="' . $media_steps['Url'] . '" width="100" height="80" alt="' . $media_steps['Caption'] . '">';
	} while ($media_steps = mysql_fetch_assoc($media));
	mysql_free_result($media);
}

$colname_StepList = "-1";
if (isset($_GET['ProjectId'])) {
  $colname_StepList = $_GET['ProjectId'];
	$ProjectId = $_GET['ProjectId'];
}
mysql_select_db($database_projector, $projector);
$query_StepList = sprintf("SELECT * FROM Steps WHERE ProjectId = %s ORDER BY SortOrder ASC", GetSQLValueString($colname_StepList, "int"));
$StepList = mysql_query($query_StepList, $projector) or die(mysql_error());
$row_StepList = mysql_fetch_assoc($StepList);
$totalRows_StepList = mysql_num_rows($StepList);

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
<title>View Steps</title>
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
<div class="subNav"><a href="ViewProjects.php">View Projects</a> | <a href="EditProject.php?Id=<?php echo $colname_StepList; ?>">Edit Project</a> | <img src="_images/icons/Plus16x16.gif" height="16" width="16"/> <a href="EditStep.php?action=Add&ProjectId=<?php echo $colname_StepList; ?>">Add Step</a> | <a href="ViewMedia.php">View Media</a> | <a href="EditMedia.php?action=Add"><img src="_images/icons/Plus16x16.gif" height="16" width="16" /> Add Media</a> | <a href="ViewTopics.php">Topics</a> | <a href="<?php echo $challengeTemplateURL; ?>?ProjectId=<?php echo $colname_StepList; ?>">View Challenge</a></div>
<?php if ($totalRows_StepList > 0): ?>
<div id="content">
<h3><?php echo $projectName; ?>&nbsp;<img id="projectImage" name="projectImage" src="<?php echo $projectImage; ?>" width="100" height="75" alt="" /></h3>
<table id="StepList" width="600" class="clearFloat">
  <tr>
    <th>Id</th>
    <th>Order</th>
    <th>Name</th>
    <th>Title</th>
    <th>Routine</th>
    <th>Template</th>
    <th>Media</th>
  </tr>
  <?php do { ?>
    <tr class="rowItem">
      <td><form id="stepForm" name="form1" method="get" action="EditStep.php"><?php echo $row_StepList['Id']; ?>
        <input style="background-image: url(_images/icons/Pencil26x26.gif); width:26px;" class="button" type="submit" name="button" id="button" value="Edit" />
        <input name="Id" type="hidden" id="Id" value="<?php echo $row_StepList['Id']; ?>" />
      </form>
      <form id="viewForm" name="viewForm" method="get" action="<?php echo $challengeTemplateURL; ?>"><input style="width:26px;" class="button" type="submit" name="button" id="button" value="View"/>
        <input name="StepId" type="hidden" id="StepId" value="<?php echo $row_StepList['Id']; ?>" />
        <input name="ProjectId" type="hidden" id="ProjectId" value="<?php echo $colname_StepList; ?>" />
        <input name="TemplateName" type="hidden" id="TemplateName" value="<?php echo $row_StepList['TemplateName']; ?>" />
      </form></td>
      <td><?php echo $row_StepList['SortOrder']; ?></td>
      <td nowrap="nowrap"><?php echo $row_StepList['LessonName']; ?></td>
      <td class="titleColumn" nowrap="nowrap"><div class="ellipsis"><?php echo $row_StepList['Title']; ?></div></td>
      <td><?php echo $row_StepList['RoutineId']; ?></td>
      <td><?php echo $row_StepList['TemplateName']; ?></td>
      <td><?php GetMediaForStep($row_StepList['Id']); ?></td>
    </tr>
    <?php } while ($row_StepList = mysql_fetch_assoc($StepList)); ?>
</table>
</div>
<?php else: ?>
<div id="errorMessage">
<p>There are no steps defined for this project.<br />Click the Add Steps button to create a step.</p>
<p><input id="editButton" class="button" style="background-image: url(_images/icons/Pencil26x26.gif); background-size: 26px 26px;" name="action" type="button" value="Add Step" onclick="goToURL('EditStep.php?action=Add&ProjectId=<?php echo $colname_StepList; ?>')" />
</p>
</div>
<?php endif; ?>
</body>
</html>
<?php
mysql_free_result($StepList);
?>
