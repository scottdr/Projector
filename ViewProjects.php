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

function getGrade($row_foundRecord)
{
	if ($row_foundRecord['GradeMin'] == $row_foundRecord['GradeMax']) {
		return $row_foundRecord['GradeMin'];
	} else {
		return $row_foundRecord['GradeMin'] . ' - ' . $row_foundRecord['GradeMax'];
	}
}

mysql_select_db($database_projector, $projector);
$query_projectList = "SELECT * FROM projects";
$projectList = mysql_query($query_projectList, $projector) or die(mysql_error());
$row_projectList = mysql_fetch_assoc($projectList);
$totalRows_projectList = mysql_num_rows($projectList);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display Projects</title>
<style type="text/css">
body {
	font-family: Arial, Helvetica, sans-serif;
}
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
	/*		border:1px solid #000;*/
	background-color: #ccc;
	border-collapse: collapse;
	padding: 5px;
	text-align: left;
	border-bottom-width: thin;
	border-bottom-color: #666;
	border-bottom-style: solid;
}	

td{
	/*	border:1px solid #000;*/
		border-collapse:collapse;
		padding:5px;
}

#content {
	margin-left:auto;
	margin-right:auto;
	width:940px;
	padding:20px;
}

/* For the Title column if the title is too long shorten it to 200px and add ellipsis */
.ellipsis {
	white-space: nowrap;
	max-width: 200px;
	overflow: hidden;
	text-overflow: ellipsis;
}

.nameColumn {
	max-width:200px;
}

</style>
<link href="_css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include("HeaderNav.php") ?>
<div class="subNav"><a href="EditProject.php?action=Add"><img src="icons/32x32_plus.png" height="16" width="16"/> Add Project</a> | <a href="ViewMedia.php">View Media</a> | <a href="ViewRoutines.php">View Routines</a> | <a href="ViewTopics.php">Topics</a></div>
<div id="content">
  <table width="300">
    <tr>
      <th>Id</th>
      <th>Image</th>
      <th>Project</th>
      <th>Author</th>
      <th>Subject</th>
      <th>Grades</th>
    </tr>
    <?php do { ?>
    <tr bgcolor="#EEEEEE" class="projectItem">
      <td><?php echo $row_projectList['Id']; ?><form id="form1" name="form1" method="get" action="EditProject.php">
        <input style="background-image: url(icons/Writing.fw.26x26png.png); width:26px;" class="button" type="submit" name="button" id="button" value="" />
        <input name="Id" type="hidden" id="Id" value="<?php echo $row_projectList['Id']; ?>" />
      </form>
        </td>
      <td nowrap="nowrap"><img src="<?php echo $row_projectList['ImgSmall']; ?>" alt="" name="" width="96" height="63" /></td>
      <td class="textTableData nameColumn" nowrap="nowrap"><div class="ellipsis"><a href="ProjectDetails.php<?php echo "?Id=" . $row_projectList['Id'] ?>"><?php echo $row_projectList['Name']; ?></a></div></td>
      <td class="textTableData" nowrap="nowrap"><div class="ellipsis"><?php echo $row_projectList['Author']; ?></div></td>
      <td class="textTableData" nowrap="nowrap"><div class="ellipsis"><?php echo $row_projectList['Subject']; ?></div></td>
      <td class="textTableData"><?php echo getGrade($row_projectList); ?></td>
    </tr>
    <tr>
      <td colspan="6" class="description textTableData"><?php echo $row_projectList['Description']; ?></td>
     
    </tr>
     <?php } while ($row_projectList = mysql_fetch_assoc($projectList)); ?>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($projectList);
?>
