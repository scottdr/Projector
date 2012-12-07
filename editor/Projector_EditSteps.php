<?php require_once('../Connections/projector.php'); ?>
<?php require_once('../Globals.php'); ?>
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

$colname_ProjectInfo = "-1";
if (isset($_GET['Id'])) {
  $colname_ProjectInfo = $_GET['Id'];
}
$routineId = -1;
if (isset($_GET['RoutineId'])) {
	$routineId = $_GET['RoutineId'];
}

mysql_select_db($database_projector, $projector);
$query_ProjectInfo = sprintf("SELECT Name FROM projects WHERE Id = %s", GetSQLValueString($colname_ProjectInfo, "int"));
$ProjectInfo = mysql_query($query_ProjectInfo, $projector) or die(mysql_error());
$row_ProjectInfo = mysql_fetch_assoc($ProjectInfo);
$totalRows_ProjectInfo = mysql_num_rows($ProjectInfo);

if ($totalRows_ProjectInfo > 0)
	$projectName = $row_ProjectInfo['Name']; 

if (isset($_GET['Id']))
	$projectId = $_GET['Id'];

// Default to performing an upate unless we posted a action on the url then use that
$action = "Update";
if (isset($_GET["action"])) {
	$action = $_GET["action"];
}

// put url parameters back on the url we pass when you click the save button to re-post form data to this same page
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if (isset($_POST["MM_action"])) {
	if ($_POST["MM_action"] == "Add") {
			$sqlCommand = sprintf("INSERT INTO Steps SET ProjectId = %s, SortOrder = %s, RoutineId = %s, Name = %s, Title = %s, TemplateName = %s, Text=%s",
                       GetSQLValueString($_POST['ProjectId'], "int"),
                       GetSQLValueString($_POST['SortOrder'], "int"),
											 GetSQLValueString($_POST['RoutineId'], "int"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Template'], "text"),
											 GetSQLValueString($_POST['Text'], "text") );
//		print "sqlCommand: " . $sqlCommand;									 
/* To Do get the id of the record we just added											 
		$sqlComamand .= ";SELECT last_insert_id( );"; 									 
*/
	} else
  	$sqlCommand = sprintf("UPDATE Steps SET ProjectId=%s, SortOrder=%s, RoutineId = %s, Name=%s, Title=%s, TemplateName=%s, Text=%s WHERE Id=%s",
                       GetSQLValueString($_POST['ProjectId'], "int"),
                       GetSQLValueString($_POST['SortOrder'], "int"),
											 GetSQLValueString($_POST['RoutineId'], "int"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Template'], "text"),
											 GetSQLValueString($_POST['Text'], "text"), 
                       GetSQLValueString($_POST['Id'], "int"));

	print "sqlCommand: " . $sqlCommand . "<br />\n";
  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());
/*
  $updateGoTo = "ViewAll.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
	$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
	$updateGoTo .= "ProjectId=" . $projectId; 
  header(sprintf("Location: %s", $updateGoTo));
*/
} 	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Define CCSoC Tasks</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="css/editor-customization.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/prettify.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-wysihtml5.css"/>

<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
<script type="text/javascript">

function populateOrderMenu(numItems) {
	var dropdown = document.getElementById("SortOrder");
	var currentCount = dropdown.options.length;
	if (numItems != currentCount) {
		  var lastItem = Math.max(numItems,currentCount)
			for (var i=0; i < lastItem;++i){
					if (i >= currentCount)    
						addOption(dropdown, String(i+1), i+1);
					else if (i >= numItems)
						dropdown.remove(numItems);
			}
	}
}

function addOption(selectbox, text, value) {
    var optn = document.createElement("OPTION");
    optn.text = text;
    optn.value = value;
    selectbox.options.add(optn);  
}

function loadStepData(ProjectId, StepNumber, StepId) {
	//alert ('user clicked on Step Id: ' + StepId + ' ProjectId = ' + ProjectId);
	populateOrderMenu(StepNumber);
	urlLoadStep = "_php/LoadStepData.php?StepId=" + StepId + '&ProjectId=' + ProjectId;
	
	$.ajax({
		url: urlLoadStep,
		cache: false
	}).done(function( jsonStepData ) {
			updateData(jsonStepData );
	});
}

/* set the values of the html form elements based on the JSON data returned from querying for the step data */
function updateData(jsonStepData) {
	var stepData = JSON.parse(jsonStepData);
	document.getElementById('Name').value = stepData.Name;
	// SCOTT To Do figure out why wysiwyg editor is not working
	document.getElementById('Text').value = stepData.Text;	
	document.getElementById('Title').value = stepData.Title;
	document.getElementById('SortOrder').value = stepData.SortOrder;
	document.getElementById('RoutineId').value = stepData.RoutineId;
	document.getElementById('Id').value = stepData.Id;
}

/* When we add a step clear out all the fields, and set the Order to the StepNumber, and select the appropriate routine Id  */
function addStep(ProjectId, StepNumber, RoutineId) {
//	alert('adding step # ' + StepNumber + " id = " + RoutineId);
	populateOrderMenu(StepNumber+1);
	document.getElementById('MM_action').value = "Add";		// set this hidden value so we know to do an insert instead of update
	document.getElementById('Name').value = "";
	// SCOTT To Do figure out why wysiwyg editor is not working
	document.getElementById('Text').value = "";	
	document.getElementById('Title').value = "";
	document.getElementById('SortOrder').value = StepNumber + 1;
	document.getElementById('RoutineId').value = RoutineId;
	document.getElementById('Id').value = "";
}

</script>
</head>

<body>

<div class="container-fluid">
	
    <?php include("EditorHeader.php"); ?>
    
	<!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      <h2 class="brand"><?php if (isset($projectName)) echo $projectName ?></h2>
        <ul class="nav">
          <li><a href="Projector_EditChallenge.php<?php if (isset($_GET['Id'])) echo "?Id=" . $_GET['Id']; ?>"><i class="icon-edit"></i> Challenge details</a></li>
          <li class="active"><a href="#"><i class="icon-edit"></i> Steps</a></li>
          <li><a href="Projector_ViewMedia.php<?php if (isset($_GET['Id'])) echo "?Id=" . $_GET['Id']; ?>"><i class="icon-eye-open"></i> Media</a></li>
          <li><a href="/ChallengeTemplate_CCSoC.php?ProjectId=<?php if (isset($_GET['Id'])) echo "?Id=" . $_GET['Id']; ?>"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Define challenge steps:
        </h3>
    </section>
  	<section class="row-fluid">
      <div class="span4 offset1">
        	<p><strong>Select a routine from the Challenge to modify steps.</strong></p>
            
           <?php require_once('_php/AccordionContent.php'); ?> 
       
      	</div>
        <div id="editStep" class="span6">
        	<form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
            <table class="table table-condensed unborderedTable">
            <caption>
            Edit a step for this project.
            <input name="ProjectId" type="hidden" id="ProjectId" value="<?php echo $projectId; ?>">
            </caption>
              <tbody>
                <tr>
                  <td colspan="2">Each step will appear as a separate step within the project ribbon.
                  <input type="hidden" name="Id" id="Id"></td>
                </tr>
                <tr>
                  <td width="140">Routine</td>
                  <td>
                      <select name="RoutineId" size="1" id="RoutineId">
                        <option value="1" selected="SELECTED">Your Challenge</option>
                        <option value="2">Start</option>
                        <option value="3">Plan</option>
                        <option value="4">Create</option>
                        <option value="5">Revise</option>
                        <option value="6">Present</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td width="140">Name</td>
                  <td><input name="Name" type="text" id="Name"></td>
                </tr>
                <tr>
                  <td width="140">Title</td>
                  <td><input type="text" name="Title" id="Title"></td>
                </tr>
                <tr>
                  <td width="140">Order <span class="muted">(step number)</span></td>
                  <td><select name="SortOrder" size="1" id="SortOrder">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                  </select></td>
                </tr>
              <!--  <tr>
                  <td width="140">Type</td>
                  <td>
                  	  <select size="1">
                        <option value="Generic" selected="SELECTED">Generic</option>
                        <option value="Individual">Individual</option>
                      </select>
                  </td>
                </tr> -->
                <tr>
                  <td width="140">Template</td>
                  <td>
                      <select name="Template" size="1" id="Template">
                        <option value="Intro" selected="SELECTED">Intro</option>
                        <option value="Splash">Splash</option>
                        <option value="Text only">Text only</option>
                        <option value="Media left">Media left</option>
                        <option value="Media right">Media right</option>
                        <option value="Icon left">Icon left</option>
                        <option value="Plan">Plan</option>
                        <option value="Research">Research</option>
                        <option value="Create">Create</option>
                        <option value="Revise">Revise</option>
                        <option value="Present">Present</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td width="140">Content</td>
                  <td>
                      <textarea name="Text" placeholder="Enter content ..." rows="10" id="Text" class="wysiwyg-editor width-auto"></textarea>
                  </td>
                </tr>
                <tr>
                  <td width="140">Template media</td>
                  <td>
                  	<a class="btn btn-small" href="#"><i class="icon-folder-open"></i> Select media from library</a>
                    &nbsp;
                    <a class="btn btn-small" href="#"><i class="icon-arrow-up"></i> Add new media</a>
                  </td>
                </tr>
                <!-- Teacher notes in the Projector exist at the project details level
                <tr>
                  <td>Teacher notes</td>
                  <td>
                      <textarea name="textarea" placeholder="Enter teacher notes ..." rows="10" id="textarea" class="wysiwyg-editor width-auto"></textarea>
                  </td>
                </tr>-->
                <tr>
                  <td width="140"><input type="hidden" name="MM_action" id="MM_action" value="<?php echo $action; ?>" /></td>
                  <td>
                  <input name="Save step" type="submit" class="btn btn-primary" id="Save step" title="Save step" value="Save step">
                  </td>
                </tr>
              </tbody>
          </table>
          </form>
      </div>
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/wysihtml5-0.3.0.js"></script>
<script src="js/prettify.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>

<script>
	$('.wysiwyg-editor').wysihtml5();
</script>

<script type="text/javascript" charset="utf-8">
	$(prettyPrint);
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#editStep").hide();
		var icons = {
            header: "ui-icon-circle-arrow-e",
            activeHeader: "ui-icon-circle-arrow-s"
        };
		$(".accordion").accordion({ collapsible: false,  icons: icons });
	});
	
	$(".step").click(function () {
		$("#editStep").show("slow");
    });
	
	$(".step-add").click(function () {
		$("#editStep").show("slow");
    });
	
	$(".closeStep").click(function () {
		$("#editStep").hide("slow");
    });
</script>
</body>
</html>
<?php
mysql_free_result($ProjectInfo);
?>
