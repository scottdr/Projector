<?php require_once('../Connections/projector.php'); ?>
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
$query_routinesQuery = "SELECT * FROM Routines";
$routinesQuery = mysql_query($query_routinesQuery, $projector) or die(mysql_error());
$row_routinesQuery = mysql_fetch_assoc($routinesQuery);
$totalRows_routinesQuery = mysql_num_rows($routinesQuery);

$colname_foundRecord = "-1";
if (isset($_GET['Id'])) {
  $colname_foundRecord = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_foundRecord = sprintf("SELECT * FROM Projects WHERE Id = %s", GetSQLValueString($colname_foundRecord, "int"));
$foundRecord = mysql_query($query_foundRecord, $projector) or die(mysql_error());
$row_foundRecord = mysql_fetch_assoc($foundRecord);
$totalRows_foundRecord = mysql_num_rows($foundRecord);

$colname_lessonRoutinesQuery = "-1";
if (isset($_GET['Id'])) {
  $colname_lessonRoutinesQuery = $_GET['Id'];
}
mysql_select_db($database_projector, $projector); 
$query_lessonRoutinesQuery = sprintf("SELECT RoutineAttach.Id, Routines.RoutineName, RoutineAttach.ProjectId, RoutineAttach.RoutineId, RoutineAttach.SortOrder FROM RoutineAttach, Routines WHERE ProjectId = 1 AND Routines.Id = RoutineAttach.RoutineId ORDER BY SortOrder ASC", GetSQLValueString($colname_lessonRoutinesQuery, "int"));
$lessonRoutinesQuery = mysql_query($query_lessonRoutinesQuery, $projector) or die(mysql_error());
$row_lessonRoutinesQuery = mysql_fetch_assoc($lessonRoutinesQuery);
$totalRows_lessonRoutinesQuery = mysql_num_rows($lessonRoutinesQuery);


if (isset($_POST['SaveRoutines'])) {
//	echo "SAVING ROUTINES\n";
	$projectId = -1;
	if (isset($_POST['ProjectId']))
		$projectId = $_POST['ProjectId'];
	if (isset($_POST['lessonRoutines']) && $projectId > -1) {
		$routinesArray = $_POST['lessonRoutines'];
//		echo "PROJECT ID: " . $projectId . "\n";
		$i = 1;
		// iterate through the routine items
		foreach ($routinesArray as $value) {
//			echo $value . ", ";
			$sqlCommand = sprintf("INSERT INTO RoutineAttach (ProjectId, RoutineId, SortOrder) VALUES (%s, %s, %s)",
													 GetSQLValueString($projectId, "int"), $value, $i);
//			echo "$sqlCommand\n<br />";
			$Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());
			
			$sqlCommand = sprintf("INSERT INTO Steps (ProjectId, RoutineId, SortOrder, Name, TemplateName) VALUES (%s, %s, %s, %s, %s)",
													 GetSQLValueString($projectId, "int"), $value, 1, GetSQLValueString("Step " . $i, "text"), GetSQLValueString("MediaLeft.php", "text"));
//			echo "$sqlCommand\n<br />";
			$Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());										 
			$i++;
		} 
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Define Common Core Routines</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="css/editor-customization.css" rel="stylesheet" type="text/css" />
<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<?php 
$projectId = -1;
if (isset($_GET['Id']))
	$projectId = $_GET['Id'];

session_start(); 
$_SESSION['ActiveNav'] = "routines";
?>
<body>
<div class="container-fluid">
	
    <?php include("EditorHeader.php"); ?>
    
	<!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      <h2 class="brand"><?php echo $row_foundRecord['Name']; ?></h2>
        <?php require("SubNav.php"); ?>
      </div>
    </div>
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Define routines: 
        </h3>
        <ul class="span11 offset1">
          <li>Select the lesson routines from the left panel and add them. Press the control key to select multiple items.</li>
          <li>You can add multiple copies of the same routine by repeating the process.</li>
        </ul>
	</section>
    <div class="row-fluid">
		<hr class="span10 offset1" />
    </div>
    <div class="row-fluid">
		<p class="span3 offset1">
        	Available routines:
        </p>
        <p class="span3 offset1">
        	Routines in this lesson:
        </p>
    </div>
    <form method="post" enctype="multipart/form-data" id="UpdateRoutines">
    <section class="row-fluid">
    		<input name="ProjectId" type="hidden" value="<?php echo $colname_foundRecord; ?>">
        <div class="span3 offset1">
            <SELECT size="15" id="routineSelection" name="routineSelection"  multiple="multiple" style="width:100%;">
              <?php
do {  
?>
              <option value="<?php echo $row_routinesQuery['Id']?>"><?php echo $row_routinesQuery['RoutineName']?></option>
              <?php
} while ($row_routinesQuery = mysql_fetch_assoc($routinesQuery));
  $rows = mysql_num_rows($routinesQuery);
  if($rows > 0) {
      mysql_data_seek($routinesQuery, 0);
	  $row_routinesQuery = mysql_fetch_assoc($routinesQuery);
  }
?>
            </SELECT>
        </div>
        <div class="span1">
            <input type="button" onClick="addRoutine()" value="&gt;" class="btn" style="width:100%; margin-bottom:10px; margin-top:60px;">
            <input type="button" onClick="removeSelectedRoutine()" value="&lt;" class="btn" style="width:100%;">
        </div>
        <div class="span3">
            <SELECT id="lessonRoutines" name="lessonRoutines[]" size="15" style="width:100%;">
            <?php
do {  
?>
              <option value="<?php echo $row_lessonRoutinesQuery['Id']?>"><?php echo $row_lessonRoutinesQuery['RoutineName']?></option>
              <?php
} while ($row_lessonRoutinesQuery = mysql_fetch_assoc($lessonRoutinesQuery));
  $rows = mysql_num_rows($lessonRoutinesQuery);
  if($rows > 0) {
      mysql_data_seek($lessonRoutinesQuery, 0);
	  $row_lessonRoutinesQuery = mysql_fetch_assoc($lessonRoutinesQuery);
  }
?>
            </SELECT>
        </div>
        <div class="span2">
            <input type="button" value="Move Up" onClick="moveItemUp()"  class="btn" style="width:100%; margin-bottom:10px; margin-top:60px;">
            <input type="button" value="Move Down" onClick="moveItemDown()" class="btn" style="width:100%;">
        </div>
    </section>
    <section class="row-fluid hidden">
    		<!-- Hide and show this div when routines are being removed from a lesson -->
            <div class="span7 offset1 alert alert-block alert-error">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Alert!</h4>
            Removing a routine from your lesson will result in the associated content being appended to the preceeding routine.
            </div>
    </section>
    <section class="row-fluid">
    	<input class="btn btn-primary span3 offset5" type="button" onClick="selectAllAndSubmit()" name="SaveRoutineButton" id="SaveRoutineButton" value="Save Routines" />
      <input name="SaveRoutines" type="hidden" value="SaveRoutines">
    </section>
    </form>
    <section class="row-fluid">
        <hr class="span10 offset1" />
    </section>
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">

function addRoutine() {
	$("#routineSelection option:selected").each(function() {
		appendRoutine($(this).val(),$(this).text());
	});
}

function appendRoutine(value,label) {
	$('#lessonRoutines').append($("<option></option>").attr("value",value).text(label));
}

function removeSelectedRoutine() {
	var optionIndex = $("#lessonRoutines option:selected").prevAll().size();
	$("#lessonRoutines option:eq(" + optionIndex + ")").remove();
}

function moveItemUp() {
	var optionIndex = $("#lessonRoutines option:selected").prevAll().size();
//	alert("remove item #: " + optionIndex);
	var selectedValue = $("#lessonRoutines option:eq(" + optionIndex + ")").val();
	var selectedLabel = $("#lessonRoutines option:eq(" + optionIndex + ")").text();
	if (optionIndex > 0) {
		var previousIndex = optionIndex - 1;
		var previousValue = $("#lessonRoutines option:eq(" + previousIndex + ")").val();
		var previousLabel = $("#lessonRoutines option:eq(" + previousIndex + ")").text();
		$("#lessonRoutines option:eq(" + optionIndex + ")").replaceWith($("<option></option>").attr("value",previousValue).text(previousLabel));
		$("#lessonRoutines option:eq(" + previousIndex + ")").replaceWith($("<option></option>").attr("value",selectedValue).text(selectedLabel));
		$("#lessonRoutines").val(selectedValue);
	}
}

function moveItemDown() {
	var optionIndex = $("#lessonRoutines option:selected").prevAll().size();
//	alert("remove item #: " + optionIndex);
	var selectedValue = $("#lessonRoutines option:eq(" + optionIndex + ")").val();
	var selectedLabel = $("#lessonRoutines option:eq(" + optionIndex + ")").text();
	var numberOptions = $("#lessonRoutines option").size();
	if (optionIndex < numberOptions - 1) {
		var nextIndex = optionIndex + 1;
		var nextValue = $("#lessonRoutines option:eq(" + nextIndex + ")").val();
		var nextLabel = $("#lessonRoutines option:eq(" + nextIndex + ")").text();
		$("#lessonRoutines option:eq(" + optionIndex + ")").replaceWith($("<option></option>").attr("value",nextValue).text(nextLabel));
		$("#lessonRoutines option:eq(" + nextIndex + ")").replaceWith($("<option></option>").attr("value",selectedValue).text(selectedLabel));
		$("#lessonRoutines").val(selectedValue);
	}
}

function selectAllAndSubmit()
{
	$("#lessonRoutines").attr("multiple","multiple");
	$("#lessonRoutines option").prop("selected",true);
	document.forms[0].submit();
}
</script>
</body>
</html>
<?php
mysql_free_result($routinesQuery);

mysql_free_result($lessonRoutinesQuery);
?>
