// JavaScript Document
//
// iPad Code to handle Swipe gestures 

var minLength = 72;

function touchEnd(event) {
	var holder 	  = document.getElementById('ContentScreens');
	var newNumber = StepNumber;
	
	if(holder.scrollLeft >= minLength)
	{
		newNumber++;
		if (newNumber > NumberOfSteps)
			newNumber = NumberOfSteps;
	}
	else if(holder.scrollLeft <= -minLength)
	{
		newNumber--;
		if (newNumber <= 0)
			newNumber = 1;
	}
			
	var e = jQuery.Event("click");
	$('div[data-number="' + newNumber + '"]').trigger(e);
}