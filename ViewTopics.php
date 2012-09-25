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

mysql_select_db($database_projector, $projector);
$query_TopicsRecordset = "SELECT Id, Featured, Name, TagLine, DisplayGalleryBadge, SmallIcon FROM Topics";
$TopicsRecordset = mysql_query($query_TopicsRecordset, $projector) or die(mysql_error());
$row_TopicsRecordset = mysql_fetch_assoc($TopicsRecordset);
$totalRows_TopicsRecordset = mysql_num_rows($TopicsRecordset);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>View Topics</title>
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
<div class="subNav"><a href="ViewProjects.php">View Projects</a> | View Steps<a href="EditStep.php?action=Add&ProjectId=<?php echo $colname_StepList; ?>"></a> | <a href="ViewMedia.php">View Media</a> | <a href="EditMedia.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16" /> Add Media</a> | <a href="EditTopic.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16" />  Add Topic</a></div>
<?php if ($totalRows_TopicsRecordset > 0): ?>
<div id="content">
<h3>View Topics</h3>
<table id="StepList" width="600" class="clearFloat">
  <tr>
    <th>Id</th>
    <th>Icon</th>
    <th>Name</th>
    <th>Tag Line</th>
    <th>Featured </th>
    </tr>
  <?php do { ?>
    <tr class="rowItem">
      <td><?php echo $row_TopicsRecordset['Id']; ?><form id="stepForm" name="form1" method="get" action="EditTopic.php">
        <input style="background-image: url(icons/Writing.fw.26x26png.png); width:26px;" class="button" type="submit" name="button" id="button" value="Edit" />
        <input name="Id" type="hidden" id="Id" value="<?php echo $row_TopicsRecordset['Id']; ?>" />
      </form></td>
      <td><img src="<?php echo $row_TopicsRecordset['SmallIcon']; ?>" alt="" name="icon" id="icon" /></td>
      <td nowrap="nowrap"><a href="EditTopic.php?Id=<?php echo $row_TopicsRecordset['Id']; ?>"><?php echo $row_TopicsRecordset['Name']; ?></a></td>
      <td class="titleColumn" nowrap="nowrap"><div class="ellipsis"><?php echo $row_TopicsRecordset['TagLine']; ?></div></td>
      <td><?php echo $row_TopicsRecordset['Featured']; ?></td>
      </tr>
    <?php } while ($row_TopicsRecordset = mysql_fetch_assoc($TopicsRecordset)); ?>
</table>
</div>
<?php else: ?>
<div id="errorMessage">
<p>There are no topics defined.<br />
  Click the Add Topics button to create a topic.</p>
<p><input id="editButton" class="button" style="background-image: url(icons/26x26_plus.fw.png); background-size: 26px 26px;" name="action" type="button" value="Add Topic" onclick="goToURL('EditTopic.php?action=Add')" />
</p>
</div>
<?php endif; ?>
</body>
</html>
<?php
mysql_free_result($TopicsRecordset);
?>
