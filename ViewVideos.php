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

$colname_MediaQuery = "-1";
if (isset($_GET['ProjectId'])) {
  $colname_MediaQuery = $_GET['ProjectId'];
}
mysql_select_db($database_projector, $projector);
if ($colname_MediaQuery == -1)
	$query_MediaQuery = "SELECT * FROM Video ORDER BY ProjectId";
else
	$query_MediaQuery = sprintf("SELECT * FROM Video WHERE ProjectId = %s", GetSQLValueString($colname_MediaQuery, "int"));
$MediaQuery = mysql_query($query_MediaQuery, $projector) or die(mysql_error());
$row_MediaQuery = mysql_fetch_assoc($MediaQuery);
$totalRows_MediaQuery = mysql_num_rows($MediaQuery);

//print 'Session[ProjectName] = ' . $_SESSION['ProjectName'];
if (isset($_GET['ProjectName'])) {
  $projectName = $_GET['ProjectName'];
} else $projectName = 'none';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>View Videos</title>
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
	float:left;
}

.rowItem:Hover{
	background-color:LightYellow;
}

.clearFloat {
	clear:both;
}
#content #MediaTable {
	margin-right: auto;
	margin-left: auto;
}

/* For the Title column if the title is too long shorten it to 200px and add ellipsis */
.ellipsis {
	white-space: nowrap;
	max-width: 200px;
	overflow: hidden;
	text-overflow: ellipsis;
}

.fixed200Column {
	max-width:200px;
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
<div class="subNav"><a href="ViewProjects.php">View Projects</a> | <a href="EditProject.php?Id=<?php echo $colname_StepList; ?>">Edit Project</a> | <img src="_images/icons/Plus16x16.gif" height="16" width="16"/> <a href="EditStep.php?action=Add&ProjectId=<?php echo $colname_StepList; ?>">Add Step</a> | <a href="EditMedia.php?action=Add"><img src="_images/icons/Plus16x16.gif" height="16" width="16"/> Add Media</a></div>
<div id="content">
<h3>View Videos <?php if ($colname_MediaQuery > -1) print "for Project Id # $colname_MediaQuery <a href=\"ViewVideos.php\">Show All</a>"; else print "for All Projects" ?></h3>
<table id="MediaTable" width="600" class="clearFloat">
  <tr>
    <th>Id</th>
    <th>Image</th>
    <th>Caption</th>
    <th align="center">Project</th>
  </tr>
  <?php do { ?>
  <tr class="rowItem">
   
      <td>
      <?php echo $row_MediaQuery['Id']; ?>
      <form id="stepForm" name="form1" method="get" action="EditVideo.php">
        <input style="background-image: url(icons/Writing.fw.26x26png.png); width:26px;" class="button" type="submit" name="button" id="button" value="Edit" />
        <input name="Id" type="hidden" id="Id" value="<?php echo $row_MediaQuery['Id']; ?>" />
      </form></td>
      <td><a href="#"><img src="<?php echo $row_MediaQuery['PosterUrl']; ?>" alt="<?php echo $row_MediaQuery['Description']; ?>" name="" width="120" height="90" /></a></td>
      <td class="fixed200Column" nowrap="nowrap"><div class="ellipsis"><a href="EditVideo.php?Id=<?php echo $row_MediaQuery['Id']; ?>"><?php echo $row_MediaQuery['Caption']; ?></a></div></td>
      <td align="center"><?php echo $row_MediaQuery['ProjectId']; ?></td>
  </tr>
   <?php } while ($row_MediaQuery = mysql_fetch_assoc($MediaQuery)); ?>
</table>
</div>
</body>
</html>
<?php
mysql_free_result($MediaQuery);
?>
