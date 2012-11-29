// JavaScript Document
//
// iPad Code to handle Swipe gestures 

var minLength = 72;
var contentScreensAnimating = false;

function touchEnd(event) {
	var fullWidth 	= parseInt(jQuery('#ContentScreens').width());
	var holder 		= document.getElementById('ContentScreens');
	var oldStep		= StepNumber;
	var animteTo	= 0;
	
	if(holder.scrollLeft >= minLength)
	{
		StepNumber++;
		if (StepNumber > NumberOfSteps)
			StepNumber = NumberOfSteps;
			
		animateTo = -fullWidth;
	}
	else if(holder.scrollLeft <= -minLength)
	{
		StepNumber--;
		if (StepNumber <= 0)
			StepNumber = 1;
		
		animateTo = fullWidth;
	}
	
	if(oldStep == StepNumber)
			return;
	
	if(animateTo != 0)
	{
		contentScreensAnimating = true;
		jQuery('#ContentScreensLoader').fadeIn(200);
		setSelectedRibbonItem(StepNumber);
		jQuery('#ContentScreens').animate({left: animateTo}, 200, function(){
			jQuery('#ContentScreens').animate({left: -animateTo}, 0);
			loadStep(-1,StepNumber);
			contentScreensAnimating = false;
		});
	}
}

$(function(){
	useSlideAnimation = true;
});