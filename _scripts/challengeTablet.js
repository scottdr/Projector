// JavaScript Document
//
// iPad Code to handle Swipe gestures 

var minLength = 72;

function touchEnd(event) {
	var holder 	  = document.getElementById('ContentScreens');
	var newNumber = StepNumber;
	
	if(holder.scrollLeft >= minLength)
	{
		console.log(holder.scrollLeft, minLength);
		newNumber++;
		if (newNumber > NumberOfSteps)
			newNumber = NumberOfSteps;
		triggerIt();
	}
	else if(holder.scrollLeft <= -minLength)
	{
		console.log(holder.scrollLeft, minLength);
		newNumber--;
		if (newNumber <= 0)
			newNumber = 0;
		triggerIt();
	}
	
	function triggerIt(){		
		var e = jQuery.Event("click");
		if(newNumber < StepNumber)
			$("#leftButton").trigger(e);
		else
			$("#rightButton").trigger(e);
	};
}