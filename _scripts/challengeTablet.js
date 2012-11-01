// JavaScript Document

//  ///////////////////////////////////////////////////////////////////////
	
	// iPad Code to handle Swipe gestures 
	
	// TOUCH-EVENTS SINGLE-FINGER SWIPE-SENSING JAVASCRIPT
	// Courtesy of PADILICIOUS.COM and MACOSXAUTOMATION.COM
	
	// this script can be used with one or more page elements to perform actions based on them being swiped with a single finger

	var triggerElementID = null; // this variable is used to identity the triggering element
	var fingerCount = 0;
	var startX = 0;
	var startY = 0;
	var curX = 0;
	var curY = 0;
	var deltaX = 0;
	var deltaY = 0;
	var horzDiff = 0;
	var vertDiff = 0;
	var minLength = 72; // the shortest distance the user may swipe
	var swipeLength = 0;
	var swipeAngle = null;
	var swipeDirection = null;
	var ribbonStartX = 0;
	var stepTarget = null;
	
	// The 4 Touch Event Handlers
	
	// NOTE: the touchStart handler should also receive the ID of the triggering element
	// make sure its ID is passed in the event call placed in the element declaration, like:
	// <div id="picture-frame" ontouchstart="touchStart(event,'picture-frame');"  ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);">

	function touchStart(event,passedName) {
		// disable the standard ability to select the touched object
		event.preventDefault();
		// get the total number of fingers touching the screen
		fingerCount = event.touches.length;
		// since we're looking for a swipe (single finger) and not a gesture (multiple fingers),
		// check that only one finger was used
		if ( fingerCount == 1 ) {
			if (passedName == 'step') {		// if we had clicked on one of the steps we first receive touch event for the step then for the outer ribbonButtons div try ignoring outer one for now
				stepTarget = event.currentTarget;
				return true;
			} 
			// get the coordinates of the touch
			startX = event.touches[0].pageX;
			startY = event.touches[0].pageY;
			// store the triggering element ID
			triggerElementID = passedName;
			if (triggerElementID == 'ribbonButtons') {	// if we are moving the ribbon 
				ribbonStartX = jQuery("#ribbonButtons").css("left");
				if (ribbonStartX == "auto") {
					ribbonStartX = 0;
				} else {
					ribbonStartX = parseInt(ribbonStartX, 10);
				}
				doLog("ribbon Touch Start pos: " + ribbonStartX,"MOVE"); 
//				event.stopPropagation();
//				return false;
			}
		} else {
			// more than one finger touched so cancel
			touchCancel(event);
		}
	}

	function touchMove(event) {
		event.preventDefault();
		if ( event.touches.length == 1 ) {
			if (triggerElementID == 'step') { // we want to ignore touchMove on the actual step
				return true;
			}
			curX = event.touches[0].pageX;
			curY = event.touches[0].pageY;
			if (triggerElementID == 'ribbonButtons') {
				deltaX = curX - startX;
				currentXPos = jQuery("#ribbonButtons").css("left");
				doLog("#ribbonButtons left: " + currentXPos,"MOVE");
				doLog("move delta x: " + deltaX,"MOVE");
				newPos = ribbonStartX + deltaX;
				doLog("new position: " + newPos,"MOVE");
				if (newPos > 0)
					newPos = 0;
				jQuery("#ribbonButtons").css("left",newPos);
				
//				jQuery("#ribbonButtons").animate({left : "-=" + StepWidth + "px"});
			}
		} else {
			touchCancel(event);
		}
	}
	
	function touchEnd(event) {
		event.preventDefault();
		doLog("-- touchEnd Start");
		// check to see if more than one finger was used and that there is an ending coordinate
		if ( fingerCount == 1 /*&& curX != 0 */) {
				doLog("-- touchEnd fingerCount == 1, curX - startX: " + curX - startX);
				// use the Distance Formula to determine the length of the swipe
				swipeLength = Math.round(Math.sqrt(Math.pow(curX - startX,2) + Math.pow(curY - startY,2)));
				// if the user swiped more than the minimum length, perform the appropriate action
				if ( swipeLength >= minLength ) {
					doLog("-- touchEnd with swipe","MOVE");
					caluculateAngle();
					determineSwipeDirection();
					processingRoutine();
					touchCancel(event); // reset the variables
				} else {
					if (triggerElementID == 'step' || triggerElementID == 'ribbonButtons') {
		
						if (stepTarget != null) {						// stepTarget is saved when user did a touchstart on the step, if it is set then user clicked on  astep
							StepNumber = stepTarget.getAttribute('data-number');
							StepId = stepTarget.getAttribute('data-id');
							doLog("stepTarget # " + StepNumber + " id: " + StepId);
							loadStep(StepId,StepNumber);
							selectStep(stepTarget);
						}
					}
					touchCancel(event);
				}
			}
		} else {
			touchCancel(event);
		}
	}

	function touchCancel(event) {
		// reset the variables back to default values
		fingerCount = 0;
		startX = 0;
		startY = 0;
		curX = 0;
		curY = 0;
		deltaX = 0;
		deltaY = 0;
		horzDiff = 0;
		vertDiff = 0;
		swipeLength = 0;
		swipeAngle = null;
		swipeDirection = null;
		triggerElementID = null;
		stepTarget = null;
	}
	
	function caluculateAngle() {
		var X = startX-curX;
		var Y = curY-startY;
		var Z = Math.round(Math.sqrt(Math.pow(X,2)+Math.pow(Y,2))); //the distance - rounded - in pixels
		var r = Math.atan2(Y,X); //angle in radians (Cartesian system)
		swipeAngle = Math.round(r*180/Math.PI); //angle in degrees
		if ( swipeAngle < 0 ) { swipeAngle =  360 - Math.abs(swipeAngle); }
	}
	
	function determineSwipeDirection() {
		if ( (swipeAngle <= 45) && (swipeAngle >= 0) ) {
			swipeDirection = 'left';
		} else if ( (swipeAngle <= 360) && (swipeAngle >= 315) ) {
			swipeDirection = 'left';
		} else if ( (swipeAngle >= 135) && (swipeAngle <= 225) ) {
			swipeDirection = 'right';
		} else if ( (swipeAngle > 45) && (swipeAngle < 135) ) {
			swipeDirection = 'down';
		} else {
			swipeDirection = 'up';
		}
	}
	
	function processingRoutine() {
		var swipedElement = document.getElementById(triggerElementID);
		if ( swipeDirection == 'left' && triggerElementID == 'ContentScreens' ) {
			StepNumber++;
			if (StepNumber > NumberOfSteps)
				StepNumber = NumberOfSteps;
			loadStep(-1,StepNumber);
			if(jQuery("#ribbonButtons").position().left > stopPosition && !jQuery("#ribbonButtons").is(":animated")){
				jQuery("#ribbonButtons").animate({left : "-=" + StepWidth + "px"});
			}
			doLog("#ribbonButtons left: " + jQuery("#ribbonButtons").css("left"));
			setSelectedRibbonItem(StepNumber);
		} else if ( swipeDirection == 'right' && triggerElementID == 'ContentScreens' ) {
			StepNumber--;
			if (StepNumber <= 0)
				StepNumber = 1;
			loadStep(-1,StepNumber);
			if(jQuery("#ribbonButtons").position().left < 0 && !jQuery("#ribbonButtons").is(":animated")){
				jQuery("#ribbonButtons").animate({left : "+=" + StepWidth + "px"});
			}
			doLog("#ribbonButtons right: " + jQuery("#ribbonButtons").css("left"));
			setSelectedRibbonItem(StepNumber);
		} else if ( swipeDirection == 'up' ) {
			// REPLACE WITH YOUR ROUTINES
		} else if ( swipeDirection == 'down' ) {
			// REPLACE WITH YOUR ROUTINES
		}
	}