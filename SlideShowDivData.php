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

function getGrade($row_Recordset)
{
	if ($row_Recordset['GradeMin'] == $row_Recordset['GradeMax']) {
		return "Grade: " . $row_Recordset['GradeMin'];
	} else {
		return "Grades: " . $row_Recordset['GradeMin'] . ' - ' . $row_Recordset['GradeMax'];
	}
}

mysql_select_db($database_projector, $projector);
$query_projectList = "SELECT * FROM projects WHERE Topic = 1";
$projectList = mysql_query($query_projectList, $projector) or die(mysql_error());
$row_projectList = mysql_fetch_assoc($projectList);
$totalRows_projectList = mysql_num_rows($projectList);

 do { ?>

<div class="captionLayer">
    <h1><a href="ProjectDetails.php?Id=<?php echo $row_projectList['Id']; ?>"><?php echo $row_projectList['Name']; ?></a></h1>
    <p><?php echo getGrade($row_projectList); ?></p>
    <p>Subject: <?php echo $row_projectList['Subject']; ?></p>
</div>

<?php } while ($row_projectList = mysql_fetch_assoc($projectList)); 

mysql_free_result($projectList);

?>
