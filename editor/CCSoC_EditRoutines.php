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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Define CCSoC Routines</title>
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
      <h2 class="brand">&lt;Lesson name&gt;</h2>
     <!--   <ul class="nav">
          <li><a href="CCSoC_EditLesson.php"><i class="icon-edit"></i> Lesson details</a></li>
          <li class="active"><a href="CCSoC_EditRoutines.php"><i class="icon-edit"></i> Routines</a></li>
          <li><a href="CCSoC_EditTasksSteps.php"><i class="icon-edit"></i> Tasks  &amp; steps</a></li>
          <li><a href="CCSoC_ViewMedia.php"><i class="icon-eye-open"></i> Media</a></li>
          <li><a href="CCSoC_Preview.php"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>-->
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
    <section class="row-fluid">
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
            <SELECT id="lessonRoutines" name="lessonRoutines" size="15" style="width:100%;">
            </SELECT>
        </div>
        <div class="span2">
            <input type="button" value="Move Up" onClick="moveItemUp()"  class="btn" style="width:100%; margin-bottom:10px; margin-top:60px;">
            <input type="button" value="Move Down" onClick="moveItemDown()" class="btn" style="width:100%;">
        </div>
    </section>
    <section class="row-fluid">
    		<!-- Hide and show this div when routines are being removed from a lesson -->
            <div class="span7 offset1 alert alert-block alert-error hidden">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Alert!</h4>
            Removing a routine from your lesson will result in the associated content being appended to the preceeding routine.
            </div>
    </section>
    <section class="row-fluid">
    	<a href="CCSoC_EditTasksSteps.php" class="span3 offset5 btn btn-primary">Save Routines</a>
    </section>
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
</script>
</body>
</html>
<?php
mysql_free_result($routinesQuery);
?>
