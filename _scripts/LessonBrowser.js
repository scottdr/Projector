// JavaScript Document

//  ///////////////////////////////////////////////////////////////////////
var ProjectId = getQueryVariable("Id", -1);
var StepId = getQueryVariable("StepId", -1);
var StepNumber = getQueryVariable("StepNumber", 1);

var lessonSteps = null;

// Ribbon Code To Handle Selecting Ribbon Items & Update Content appropriately 
/* load Data for the Content area below the ribbon, call LoadStep.php with StepId or Step Number to load the contents */
function loadStep(ProjectId,StepId,StepOrderNumber) 
{
		var urlLoadStep = "LoadStep.php";
		if (StepId > -1)
			urlLoadStep += "?StepId=" + StepId + '&ProjectId=' + ProjectId;
		else
			urlLoadStep +=  "?StepNumber=" + StepOrderNumber + '&ProjectId=' + ProjectId;
			
		$.ajax({
			url: urlLoadStep,
			cache: false
		}).done(function( html ) {	
				$('#LessonContent').html(html);
		});
}

function loadLessonSteps()
{
	var jsonUrl = "_php/LessonNavigatorInfo.php?Id=" + ProjectId;
	
	$.ajax({
		url: jsonUrl,
		cache: false
	}).done(function( json ) {
			lessonSteps = jQuery.parseJSON( json );
	});
}

/* call this function to select a step by its sequential step number 
   will load the step contents, update the routine name, & icon, step title, and update the selected step number*/
function selectStep(stepNumber) {
	if (stepNumber > lessonSteps.length) {
		newStepNumber = lessonSteps.length;
	} else if (stepNumber < 1) {	// if we selected before the first step then 
		newStepNumber = 1;
	} else
		newStepNumber = stepNumber;
	
	$('#RoutineName').html(lessonSteps[newStepNumber-1].RoutineName);	
	$('#StepTitle').html(lessonSteps[newStepNumber-1].StepTitle);
	loadStep(ProjectId,lessonSteps[newStepNumber-1].StepId);
	$('#lesson-ribbon').html(String(newStepNumber));
	$("#lesson-ribbon").attr("data-number",String(newStepNumber));	
}