// JavaScript Document

//  ///////////////////////////////////////////////////////////////////////
var ProjectId = getQueryVariable("Id", -1);
var StepId = getQueryVariable("StepId", -1);
var StepNumber = getQueryVariable("StepNumber", 1);

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