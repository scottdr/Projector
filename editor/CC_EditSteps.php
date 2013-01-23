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

session_start(); 
$_SESSION['ActiveNav'] = "steps";

$colname_ProjectInfo = "-1";
if (isset($_GET['Id'])) {
  $colname_ProjectInfo = $_GET['Id'];
}
$routineId = -1;
if (isset($_GET['RoutineId'])) {
	$routineId = $_GET['RoutineId'];
}

mysql_select_db($database_projector, $projector);
$query_ProjectInfo = sprintf("SELECT Name FROM Projects WHERE Id = %s", GetSQLValueString($colname_ProjectInfo, "int"));
$ProjectInfo = mysql_query($query_ProjectInfo, $projector) or die(mysql_error());
$row_ProjectInfo = mysql_fetch_assoc($ProjectInfo);
$totalRows_ProjectInfo = mysql_num_rows($ProjectInfo);

if ($totalRows_ProjectInfo > 0)
	$projectName = $row_ProjectInfo['Name']; 

$projectId = 1;
if (isset($_GET['Id']))
	$projectId = $_GET['Id'];

// Default to performing an upate unless we posted a action on the url then use that
$action = "Edit";
if (isset($_GET["action"])) {
	$action = $_GET["action"];
}

// put url parameters back on the url we pass when you click the save button to re-post form data to this same page
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$query_lessonRoutinesQuery = sprintf("SELECT RoutineAttach.Id, Routines.RoutineName, RoutineAttach.ProjectId, RoutineAttach.RoutineId, RoutineAttach.SortOrder FROM RoutineAttach, Routines WHERE ProjectId = %s AND Routines.Id = RoutineAttach.RoutineId ORDER BY SortOrder ASC", GetSQLValueString($projectId, "int"));
$lessonRoutinesQuery = mysql_query($query_lessonRoutinesQuery, $projector) or die(mysql_error());
$row_lessonRoutinesQuery = mysql_fetch_assoc($lessonRoutinesQuery);
$totalRows_lessonRoutinesQuery = mysql_num_rows($lessonRoutinesQuery);

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

//	print "sqlCommand: " . $sqlCommand . "<br />\n";
  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());
	
	// when we are done updating 
	$updateGoTo = "../Projector_EditSteps.php";
	$updateGoTo .= "?Id=" . $projectId; 
	if (isset($routineId))
		$updateGoTo .= "&RoutineId=" . $routineId;	
	
	$originalSortOrder = GetSQLValueString($_POST['OriginalSortOrder'], "int");
	$newSortOrder = GetSQLValueString($_POST['SortOrder'], "int");
	// if the sort order changed then we are going to need to update the sort order
	if ($originalSortOrder != $newSortOrder)	{
//		$projectId = GetSQLValueString($_POST['ProjectId'],int);
		$stepId = GetSQLValueString($_POST['Id'],"int");
		$projectId = GetSQLValueString($_POST['ProjectId'],"int");
		$routineId = GetSQLValueString($_POST['RoutineId'],"int");
		$reOrderURL = "_php/ReorderSteps.php?Action=Reorder&StepId=" . $stepId . "&ProjectId=" . $projectId . "&RoutineId=" . $routineId . "&StepNumber=" . $originalSortOrder . "&NewOrder=" . $newSortOrder . "&GoTo=" . $updateGoTo;
		echo "url = $reOrderURL\n<br />";
		header(sprintf("Location: %s", $reOrderURL));
	}
	
	
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
var editor;
var editorInstance;
var stepId;
var projectId;
var formChanged = false;  // set to true to indicate a form element has changed
var goingToStep;

thumbnailMap ={'Intro.php': '1-Intro.png','Splash.php':'2-Splash.png', 'CC_TextOnly.php' : '3-TextOnly.png', 'CC_MediaLeft.php' : '4-MediaLeft.png','CC_MediaRight.php' : '5-MediaRight.png', 'IconLeft.php' : '6-IconLeft.png', 'Research.php' : '7-Research.png','Plan.php' : '8-Plan.png','Create.php' : '9-Create.png','Revise.php' : '10-Revise.png', 'Present.php' : '11-Present.png',};


function populateOrderMenu(numItems,selectedItem) {
	var dropdown = document.getElementById("SortOrder");
	var currentCount = dropdown.options.length;
	if (numItems != currentCount) {
		  var lastItem = Math.max(numItems,currentCount)
			for (var i=0; i < lastItem;++i){
					if (selectedItem == i + 1)
						selected = true;
					else
						selected = false;
					if (i >= currentCount)    
						addOption(dropdown, String(i+1), i+1,selected);
					else if (i >= numItems)
						dropdown.remove(numItems);
			}
	}
}

function addOption(selectbox, text, value, selected) {
    var optn = document.createElement("OPTION");
    optn.text = text;
    optn.value = value;
		if (selected)
			optn.selected = true;
    selectbox.options.add(optn);  
}

function StepInfo(ProjectId, StepNumber, StepId) {
	this.projectId = ProjectId;
	this.stepNumber = StepNumber;
	this.stepId = StepId;
}

function loadStepData(ProjectId, StepNumber, StepId) {
	//alert ('user clicked on Step Id: ' + StepId + ' ProjectId = ' + ProjectId);
	if (formChanged) {
		goingToStep = new StepInfo(ProjectId,StepNumber,StepId);
		displayPromptToSave();
		formChanged = false;
	} else {
		stepId = StepId;	// set global
		populateOrderMenu(StepNumber);
		urlLoadStep = "_php/LoadStepData.php?StepId=" + StepId + '&ProjectId=' + ProjectId;
		
		$.ajax({
			url: urlLoadStep,
			cache: false
		}).done(function( jsonStepData ) {
				updateData(jsonStepData );
		});
	}
}

/* set the values of the html form elements based on the JSON data returned from querying for the step data */
function updateData(jsonStepData) {
	var stepData = JSON.parse(jsonStepData);
	document.getElementById('Name').value = stepData.Name;
	// SCOTT To Do figure out why wysiwyg editor is not working
	document.getElementById('Text').value = stepData.Text;
	if (editorInstance) {
		editorInstance.setValue(stepData.Text,true);
	}
	document.getElementById('Title').value = stepData.Title;
	document.getElementById('SortOrder').value = stepData.SortOrder;
	document.getElementById('OriginalSortOrder').value = stepData.SortOrder;
	document.getElementById('RoutineId').value = stepData.RoutineId;
	document.getElementById('Template').value = stepData.TemplateName;
	updateThumbnailImage(stepData.TemplateName);
	document.getElementById('Id').value = stepData.Id;
	displayAttachedMedia(stepData.Id);		// update the display of attached media
}

/* When we add a step clear out all the fields, and set the Order to the StepNumber, and select the appropriate routine Id  */
function addStep(ProjectId, StepNumber, RoutineId) {
//	alert('adding step # ' + StepNumber + " id = " + RoutineId);
	
	populateOrderMenu(StepNumber+1,StepNumber+1);
	document.getElementById('MM_action').value = "Add";		// set this hidden value so we know to do an insert instead of update
	document.getElementById('Name').value = "";
	// SCOTT To Do figure out why wysiwyg editor is not working
	document.getElementById('Text').value = "";	
	if (editorInstance) {		// clear out wysiwyg editor contents
		editorInstance.setValue("",true);
	}
	document.getElementById('Title').value = "";
	document.getElementById('SortOrder').value = StepNumber + 1;
	document.getElementById('OriginalSortOrder').value = StepNumber + 1;
	document.getElementById('RoutineId').value = RoutineId;
	document.getElementById('Template').value = "MediaLeft.php";
	updateThumbnailImage("CC_MediaLeft.php");	
	document.getElementById('Id').value = "";
}

function deleteStep() 
{
	var stepId = document.getElementById('Id').value;
	var projectId = document.getElementById('ProjectId').value;
	var routineId = document.getElementById('RoutineId').value;
	window.location = "_php/DeleteStep.php?Id=" + stepId + "&ProjectId=" + projectId + "&RoutineId=" + routineId;
}

function attachMedia(projectId,type)
{
	var urlValue = "MediaData.php?ProjectId=" + projectId;
	urlValue += "&StepId=" + document.getElementById('Id').value;
	if (type == "video")
		urlValue += "&type=video";
	$.ajax({
  	url: urlValue,
  	cache: false
	}).done(function( html ) {
		$("#ModalBody").html(html);		// replace the html body with resulting html 
		$("#MediaDialog").modal({                    // finally, wire up the actual modal functionality and show the dialog
								"backdrop"  : "static",
								"keyboard"  : true,
								"show"      : true                     // ensure the modal is shown immediately
							});
	});
}

function displayAttachedMedia(stepId)
{
	var urlValue = "AttachedMediaQuery.php";
	urlValue += "?StepId=" + stepId;
	$.ajax({
  	url: urlValue,
  	cache: false
	}).done(function( html ) {
		$("#MediaAttach").html(html);
	});
}

function CloseDialog() {
	$("#MediaDialog").modal('hide');
}

function ClosePromptDialog() {
	$("#PromptToSave").modal('hide');	// hide the dialog
	formChanged = false;	// clear out the form changed value
	// now navigate to new step
	loadStepData(goingToStep.projectId, goingToStep.stepNumber, goingToStep.stepId );
}

/* Clicked the Ok button to attach selected items to the selected step */
function okClicked() {

	$("#MediaDialog").modal('hide');
	var checked = $('#MediaTable input:checked');
	var addString = "";
	$(checked).each(function(index){
    //do stuff here with this
		if (index > 0)
			addString += ",";
		var id = $(this).attr("id");
		addString += id;
	});
	var urlValue = "_php/AttachMedia.php";
	urlValue += "?StepId=" + stepId + "&ProjectId=" + projectId + "&MediaId=" + addString;
	$.ajax({
  	url: urlValue,
  	cache: false
	}).done(function( html ) {
		displayAttachedMedia(stepId);		// update the list of attached images
	});
}


function displayPromptToSave() {
	$("#PromptToSave").modal({                    // finally, wire up the actual modal functionality and show the dialog
								"backdrop"  : "static",
								"keyboard"  : true,
								"show"      : true                     // ensure the modal is shown immediately
							});
}
/* Clicked the Ok button to attach selected items to the selected step */
function saveChanges() {
	$("#PromptToSave").modal('hide');
	$("#updateForm").submit();
	formChanged = false;
	loadStepData(goingToStep.projectId, goingToStep.stepNumber, goingToStep.stepId );
}


function detachMedia(mediaAttachId)
{
	var urlValue = "_php/DetachMedia.php";
	urlValue += "?MediaAttachId=" + mediaAttachId;
	$.ajax({
  	url: urlValue,
  	cache: false
	}).done(function( html ) {
		displayAttachedMedia(stepId);		// update the list of attached images
	});
}

function updateThumbnailImage(templateName)
{
	var newThumbnailSrc = "/lessonTemplates/images/thumbnails/" + thumbnailMap[templateName];
	document.getElementById('thumbnailImage').src = newThumbnailSrc;
}

function doTemplateChange(combobox) {
	var newThumbnailSrc = "/lessonTemplates/images/thumbnails/" + thumbnailMap[combobox.value];
	document.getElementById('thumbnailImage').src = newThumbnailSrc;
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
        <?php require("SubNav.php"); ?>        
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
                  <td width="140">Routine                  </td>
                  <td>
                  	<select name="RoutineId" size="1" id="RoutineId">
											<?php
												if ($totalRows_lessonRoutinesQuery > 0 ) {
													do {  
														echo '<option value="' .  $row_lessonRoutinesQuery['RoutineId'] . '">' . $row_lessonRoutinesQuery['RoutineName'] . "</option>";
													} while ($row_lessonRoutinesQuery = mysql_fetch_assoc($lessonRoutinesQuery));
												}
											?>        
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
                  <td width="140">Order <span class="muted">(step number)
                    <input type="hidden" name="OriginalSortOrder" id="OriginalSortOrder">
                  </span></td>
                  <td><select name="SortOrder" size="1" id="SortOrder">
                  	</select>
                  </td>
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
                  <td><select name="Template" size="1" id="Template" onChange="doTemplateChange(this)">
                    <option value="Intro.php" selected="SELECTED">Intro</option>
                    <option value="Splash.php">Splash</option>
                    <option value="CC_TextOnly.php">CC Text only</option>
                    <option value="CC_MediaLeft.php">CC Media left</option>
                    <option value="CC_MediaRight.php">CC Media right</option>
                    <option value="IconLeft.php">Icon left</option>
                    <option value="Plan.php">Plan</option>
                    <option value="Research.php">Research</option>
                    <option value="Create.php">Create</option>
                    <option value="Revise.php">Revise</option>
                    <option value="Present.php">Present</option>
                    </select>
                    <div id="TemplateThumbnail"><img src="../lessonTemplates/images/thumbnails/1-Intro.png" name="thumbnailImage" id="thumbnailImage"></div>
                  </td>
                </tr>
                <tr>
                  <td width="140">Content</td>
                  <td>
                      <textarea name="Text" placeholder="Enter content ..." rows="10" id="Text" class="wysiwyg-editor width-auto"></textarea>
                  </td>
                </tr>
                <tr>
                  <td width="140">Media</td>
                  <td>
                  	<a class="btn btn-small" href="#" onclick="attachMedia(<?php echo $projectId; ?>,'image')"><i class="icon-folder-open"></i> Select media from library</a>
                    &nbsp;
                    <a class="btn btn-small" href="Projector_MediaEdit.php?action=Add&ProjectId=<?php echo $projectId; ?>"><i class="icon-arrow-up"></i> Add new media</a>
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
                  <td>&nbsp;</td>
                  <td><div id="MediaAttach"></div></td>
                </tr>
                <tr>
                  <td width="140"><input type="hidden" name="MM_action" id="MM_action" value="<?php echo $action; ?>" /></td>
                  <td>
                  <input name="Save step" type="submit" class="btn btn-primary" id="Save step" title="Save step" value="Save step"> <a onClick="deleteStep()" class="btn btn-primary btn-danger">Delete</a></td>
                </tr>
              </tbody>
          </table>
          </form>
      </div>
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<div id="MediaDialog" class="modal hide fade">
	<div class="modal-header">
  	<a href="#" class="close" data-dismiss="modal">&times;</a>
  	<h3>Select the media to be attached</h3>
  </div>
  <div id="ModalBody" class="modal-body">
  	<div class="divDialogElements">
    </div>
  </div>
  <div class="modal-footer"> <a href="#" class="btn" onClick="CloseDialog();">Cancel</a> <a href="#" class="btn btn-primary" onClick="okClicked();">Attach</a> </div>
</div>
<div id="PromptToSave" class="modal hide fade">
	<div class="modal-header">
  	<a href="#" class="close" data-dismiss="modal">&times;</a>
  	<h3>Save Changes</h3>
    
  </div>
  <div id="ModalBody" class="modal-body">
  	<div class="divDialogElements">
    	Do you want to save your changes?
    </div>
  </div>
  <div class="modal-footer"> <a href="#" class="btn" onClick="ClosePromptDialog();">Cancel</a> <a href="#" class="btn btn-primary" onClick="saveChanges();">Save</a> </div>
</div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/wysihtml5-0.3.0.js"></script>
<script src="js/prettify.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>

<script>
//	var editor = $('.wysiwyg-editor').wysihtml5();
</script>

<script type="text/javascript" charset="utf-8">
	$(prettyPrint);
</script>

<script type="text/javascript">

	
	$(document).ready(function() {
		// set the projectId global variable when document is loaded from the hidden element, could also pull this off of the url
		projectId = document.getElementById('ProjectId').value;
		
		editor = $('.wysiwyg-editor').wysihtml5();
		editorInstance = editor.data('wysihtml5').editor;
		
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
		
	$('form :input').change(function(){
   	formChanged = true;
//		console.log("form changed");
		});
</script>
</body>
</html>
<?php
mysql_free_result($ProjectInfo);
?>
