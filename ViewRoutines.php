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
$query_Routines = "SELECT * FROM Routines";
$RoutinesQuery = mysql_query($query_Routines, $projector) or die(mysql_error());
$row_RoutineQuery = mysql_fetch_assoc($RoutinesQuery);
$totalRows_MediaQuery = mysql_num_rows($RoutinesQuery);

//print 'Session[ProjectName] = ' . $_SESSION['ProjectName'];
if (isset($_GET['ProjectName'])) {
  $projectName = $_GET['ProjectName'];
} else $projectName = 'none';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>View Routines</title>
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
<div class="subNav"><a href="ViewProjects.php">View Projects</a> | <a href="EditProject.php?Id=<?php echo $colname_StepList; ?>">Edit Project</a> | <img src="_images/icons/Plus16x16.gif" height="16" width="16"/> <a href="EditStep.php?action=Add&ProjectId=<?php echo $colname_StepList; ?>">Add Step</a> | <a href="EditMedia.php?action=Add"><img src="_images/icons/Plus16x16.gif" height="16" width="16"/> Add Media</a> | <a href="EditRoutine.php?action=Add"><img src="_images/icons/Plus16x16.gif" height="16" width="16"/> Add Routine</a></div>
<div id="content">
<h3>View Routines</h3>
<table id="MediaTable" width="600" class="clearFloat">
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>CSS</th>
    </tr>
  <?php do { ?>
  <tr class="rowItem">
   
      <td nowrap="nowrap">   
        <form id="stepForm" name="form1" method="get" action="EditRoutine.php">
        	<?php echo $row_RoutineQuery['Id']; ?>
          <input style="background-image: url(icons/Writing.fw.26x26png.png); width:26px;" class="button" type="submit" name="button" id="button" value="Edit" />
          <input name="RoutineId" type="hidden" id="Id" value="<?php echo $row_RoutineQuery['Id']; ?>" />
         </form>
      </td>
      <td nowrap="nowrap"><a href="EditRoutine.php?RoutineId=<?php echo $row_RoutineQuery['Id']; ?>"><?php echo $row_RoutineQuery['RoutineName']; ?></a></td>
      <td nowrap="nowrap"><?php echo $row_RoutineQuery['CSSName']; ?></td>
      </tr>
   <?php } while ($row_RoutineQuery = mysql_fetch_assoc($RoutinesQuery)); ?>
</table>
</div>
</body>
</html>
<?php
mysql_free_result($RoutinesQuery);
?>
