<?php require_once('Connections/projector.php'); ?>
<?php require_once('Globals.php'); ?>
<?php require_once('GetMediaForStep.php'); ?>
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

$colname_StepQuery = "-1";
if (isset($_GET['StepId'])) {
  $colname_StepQuery = $_GET['StepId'];
}
if (isset($_GET['StepNumber'])) {
  $StepNumber = $_GET['StepNumber'];
}
if (isset($_GET['ProjectId'])) {
  $ProjectId = $_GET['ProjectId'];
}
mysql_select_db($database_projector, $projector);
if (isset($ProjectId) && isset($StepNumber))
	$query_StepQuery = sprintf("SELECT * FROM Steps WHERE ProjectId = %s AND SortOrder = %s", GetSQLValueString($ProjectId, "int"), GetSQLValueString($StepNumber, "int"));
else 
	$query_StepQuery = sprintf("SELECT * FROM Steps WHERE Id = %s", GetSQLValueString($colname_StepQuery, "int"));
// print "sql: " . $query_StepQuery;
$StepQuery = mysql_query($query_StepQuery, $projector) or die(mysql_error());
$row_StepQuery = mysql_fetch_assoc($StepQuery);
$totalRows_StepQuery = mysql_num_rows($StepQuery);

$StepId = $row_StepQuery['Id'];
//print "StepId: " . $StepId . "\n";
//print "Lesson Name: " . $row_StepQuery['LessonName'] . "\n";

$mediaArray = GetMediaForStep($StepId);

$templateName = "lessonTemplates/" . $row_StepQuery['TemplateName'];
require($templateName);

mysql_free_result($StepQuery);


// if we are in common core then look for TeacherNotes
if (isset($PROJECTOR['cc']) && $PROJECTOR['cc'] == true) {
	mysql_select_db($database_projector, $projector);
	$query_NotesQuery = sprintf("SELECT * FROM TeacherNotes WHERE StepId = %s", $StepId);
	$NotesQuery = mysql_query($query_NotesQuery, $projector) or die(mysql_error());
	$row_NotesQuery = mysql_fetch_assoc($NotesQuery);
	$totalRows_NotesQuery = mysql_num_rows($NotesQuery);
//	echo "teacher notes: " . $row_NotesQuery['Text']; 
	mysql_free_result($NotesQuery);

}
?>
<?php if ($totalRows_NotesQuery > 0) : ?>
 <!-- TeacherNotes Starts -->
  <div id="TeacherNotes">
	  <div id="TeacherNotes-Info-CC">
      </div>
      <div id="TeacherNotes-Close-CC">
      </div>
      <div id="TeacherNotesShadow-CC">
      </div>
      <div id="TeacherNotes-Text-CC">
      <?php echo $row_NotesQuery['Text']; ?>
      </div>
  </div>
<!-- TeacherNotes Ends -->
<?php endif; ?>