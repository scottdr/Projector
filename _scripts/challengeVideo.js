// JavaScript Document

// From the URL get the ProjectId if it is defined otherwise default to ProjectId of -1
var ProjectId = getQueryVariable("ProjectId", -1);
var StepId = getQueryVariable("StepId", -1);
var StepNumber = getQueryVariable("StepNumber", 1);


// animationDuration: Duration of animations in milliseconds. In future, could be set in Presentation data.
//  Each slide is composed of a series of animations.
//  This is the amount of time it takes for a particular animation to complete. Example: fade in time of image1 in slide 2 = animDuration ms.
var animationDuration = 1000;
// animationStartDelay: Duration in ms to wait between animations in a given slide.
var animationStartDelay = 1000;
// slideDuration: Length of time in milliseconds that a slide is shown.
var slideDuration = 20000;

// Challenge Video content data. cvd == challenge video data.
//
// Content data object. Contains entire descriptive and layout data for one presentation (aka slide show).
//	audioURL:	Streaming audio file URL.
//	images:		Array of image groups. Each group contains group layout and URLs of images comprising the group. Layout refers to css class name for group.
//	[layouts:	Array describing layouts used by images. ]  <<< currently just handled in css.
//	textTrack:	Array data of discrete text data associated with time of appearance in milliseconds.
var cvd;

var presentationGroup;
var presentationGroupNext;
var presentationIndex;
/* State of presentation playback. Values:
		complete:	Not playing. Presentation has finished.
		paused: 	Not playing. In midst of presentation.
		playing: 	Playing. In midst of presentation.
		stopped: 	Not playing. Presentation has not begun.
	*/
var presentationState = "stopped";
var textGroups = [];
// Timing of text broken into intervals between appearance (vs. cvd textTrack key times which are in ms from start of presentation).
var textTimeIntervals = [];
var textTrackIndex;
var useTextTrack = false;

// Image links.
var pauseBtnImg = "assets/images/challengeintro_pause.png";
var playBtnImg = "assets/images/challengeintro_arrow.png";
var replayBtnImg = "assets/images/challengeintro_replay.png";



$(document).ready(function(){ 

	if(jQuery("#ribbonButtons").length){
		
		// Declare variables
		var visibleWidth = jQuery("#ribbonStrip").outerWidth(true),
			ribbonWidth = jQuery("#ribbonButtons").outerWidth(true),
			stopPosition = (visibleWidth - ribbonWidth);
			
		jQuery("#ribbonButtons").width(ribbonWidth);
		
		jQuery("#leftButton").click(function(){
			//need to write if statment to check if the left position is offset more that the ribbonWidth
			if(jQuery("#ribbonButtons").position().left < 0 && !jQuery("#ribbonButtons").is(":animated")){
				jQuery("#ribbonButtons").animate({left : "+=" + visibleWidth + "px"});
			}
			return false;
		});
		
		jQuery("#rightButton").click(function(){
			//need to write if statment to check if the left position is offset more that the ribbonWidth
			if(jQuery("#ribbonButtons").position().left > stopPosition && !jQuery("#ribbonButtons").is(":animated")){
				jQuery("#ribbonButtons").animate({left : "-=" + visibleWidth + "px"});
			}
			return false;
		});
		
		// TO DO don't hard code these values
		loadStep(StepId,StepNumber);
	}
	
	// call when you click on any of the steps in the ribbon, clear current selected step and select the step user clicked on 
	$('div[data-type="wrapper"]').click(function(event){
			// remove all steps that are currently selected, have class set to ribbonChallengeBottomCurrent by changing the class to "ribbonChallengeBottom"
			jQuery('.ribbonChallengeBottomCurrent').removeClass('ribbonChallengeBottomCurrent').addClass('ribbonChallengeBottom');
			jQuery('.ribbonStartBottomCurrent').removeClass('ribbonStartBottomCurrent').addClass('ribbonStartBottom');
			jQuery('.ribbonPlanBottomCurrent').removeClass('ribbonPlanBottomCurrent').addClass('ribbonPlanBottom');
			jQuery('.ribbonCreateBottomCurrent').removeClass('ribbonCreateBottomCurrent').addClass('ribbonCreateBottom');
			jQuery('.ribbonReviseBottomCurrent').removeClass('ribbonReviseBottomCurrent').addClass('ribbonReviseBottom');
			jQuery('.ribbonPresentBottomCurrent').removeClass('ribbonPresentBottomCurrent').addClass('ribbonPresentBottom');
			
			
			// remove all visible selected step call outs (arrow pointing down below the step) and hide them
			jQuery('div[data-type="selector"]').removeClass('visibleStyle').addClass('hiddenStyle');
				// Add the visible style to the selected lower div to display the arrow pointing down, div class=ribbonChallengeSelector
			jQuery('div[data-type="selector"]',event.currentTarget).addClass("visibleStyle");
			// Add Current to class for the step so that it stays highlighted in appropriate color
			jQuery(".ribbonChallengeBottom",event.currentTarget).removeClass("ribbonChallengeBottom").addClass("ribbonChallengeBottomCurrent");
			jQuery(".ribbonStartBottom",event.currentTarget).removeClass("ribbonStartBottom").addClass("ribbonStartBottomCurrent");	
			jQuery(".ribbonPlanBottom",event.currentTarget).removeClass("ribbonPlanBottom").addClass("ribbonPlanBottomCurrent");
			jQuery(".ribbonCreateBottom",event.currentTarget).removeClass("ribbonCreateBottom").addClass("ribbonCreateBottomCurrent");	
			jQuery(".ribbonReviseBottom",event.currentTarget).removeClass("ribbonReviseBottom").addClass("ribbonReviseBottomCurrent");	
			jQuery(".ribbonPresentBottom",event.currentTarget).removeClass("ribbonPresentBottom").addClass("ribbonPresentBottomCurrent");	
	});

	$('div[data-type="wrapper"]').click(function(event)
	{
		StepNumber = event.currentTarget.getAttribute('data-number');
		StepId = event.currentTarget.getAttribute('data-id');
		loadStep(StepId,StepNumber);
	});

	/* load Data for the Content area below the ribbon, call LoadStep.php with Project Id, StepId or Step Number to load the contents */
	function loadStep(StepId,StepOrderNumber) {
		//alert ('user clicked on Step #: ' + StepOrderNumber + ' Step Id: ' + StepId + ' ProjectId = ' + ProjectId);
		var urlLoadStep = "LoadStep.php";
		if (StepId > -1)
			urlLoadStep = "LoadStep.php?StepId=" + StepId + '&ProjectId=' + ProjectId;
		else
			urlLoadStep =  "LoadStep.php?StepNumber=" + StepOrderNumber + '&ProjectId=' + ProjectId;
		$.ajax({
			url: urlLoadStep,
			cache: false
		}).done(function( html ) {
				var contentElement = document.getElementById("ContentScreens");
				contentElement.innerHTML = html;
				// if we are on the very first step
				if (StepOrderNumber == 1) {
					requestPresentationData(ProjectId);
				}
		});
	};
	
	
	
	//  ///////////////////////////////////////////////////////////////////////
	
	// Presentation functionality.
	
	
  
  // Send a request to the server for the presentation data.
  function requestPresentationData(projectId) {
	  // ::todo::
	  //   Success >> callback setPresentationData( JSONResultStr )
	  
		// the following url returns a json data feed of the info for the slide show
		var jsonUrl = "SlideShowJSON.php?ProjectId=" + projectId;
		
		$.ajax({
			url: jsonUrl,
			cache: false
		}).done(function( json ) {
	 			setPresentationData( json );
		});
  }
  
  
 // Parse the returned JSON string into useable data object, and initialize the presentation.
  function setPresentationData( dataJSONStr ) {
	  cvd = jQuery.parseJSON( dataJSONStr );
	  // ::kludge:: Clean up data values. Some database values don't match actual expected values.
	  cleanData();
	  initPresentation();
  }
  
  
  function cleanData() {
	  for (var i=0; i<cvd.slides.length; i++) {
		  switch (cvd.slides[i].layout) {
			  case "3xLandscape":
				cvd.slides[i].layout = "landscapex3";
			  	break;
			  case "2xLandscape":
				cvd.slides[i].layout = "landscapex2";
				break;
			  case "1Portrait1Landscape":
			  	cvd.slides[i].layout = "portrait";
				break;
		  }
	  }
  }	
	
	// Initialize presentation
	function initPresentation() {
		// Init vars.
		presentationState = "stopped";
		animationDuration = 1000;
		animationStartDelay = 1000;
		slideDuration = 20000;
		if (cvd.audioLength) {
			// ::kludge:: Add a 1.5 second buffer to this value. Shields for rounding errors in audio (1 sec), plus another 0.5 for good measure.
			var presentationLength = (cvd.audioLength *1000) + 1500;
			slideDuration = Math.floor( presentationLength / cvd.slides.length );
		}
		// Content interaction.
	  var hotspot = jQuery("#ChallengeWrapper")
	  hotspot.click( function(event) {
		switch (presentationState) {
			case "complete":
				resetPresentation();
				startPresentation();
				break;
			case "paused":
				playPresentation();
				break;
			case "playing":
				pausePresentation();
				break;
			case "stopped":
				startPresentation();
				break;
		}
	  });
	  hotspot.mousemove( function(event) {
		  if (presentationState == "playing") {
			  resetPauseBtn();
		  }
	  });
	  
	  // Establish text groupings and timings.
		var timeOffset = 0;
		/* Deprecated.
		  Provides method for setting a series of key:value timings for an independent text animation.
		  key = time in ms when text appears, measured from presentation start.
		  value = text content to display, provided as html blob.
		for (var key in cvd.textTrack) {
			textGroups.push( cvd.textTrack[key] );
			textTimeIntervals.push( key - timeOffset );
			timeOffset = key;
		} */
	  
		resetPresentation();
		
		// Initialize and display title.
		jQuery("#ChallengeTitleAuthor").text(cvd.author);
		jQuery("#ChallengeTitleProject").text(cvd.title);
		jQuery("#ChallengeTitle").fadeIn(animationDuration);
		
		// Initialize audio player.
	    pfInitAudio(cvd.audioURLM4A, cvd.audioURLOGG, audioStarted, audioProgress, audioCompleted );
	}
	
	
	function resetPresentation() {
	  presentationGroup = jQuery("#ChallengeGroupA");
	  presentationGroupNext = jQuery("#ChallengeGroupB");
	  presentationGroup.css("z-index",2);
	  presentationGroupNext.css("z-index",3);
	  presentationIndex = 0;
	  textTrackIndex = 0;
	  // Establish data for current presentation group, and upcoming presentation group.
	  // Old format:
	  //var groupImages = cvd.images[presentationIndex];
	  var groupImages = cvd.slides[presentationIndex].images;
	  var nextIndex = presentationIndex + 1;
	  //if (cvd.images.length == (nextIndex+1)) {
	  if (cvd.slides.length == (nextIndex+1)) {
		  nextIndex = 0;
	  }
	  //var groupImagesNext = cvd.images[nextIndex];
	  var groupImagesNext = cvd.slides[nextIndex].images;
	  // Set group layout.
	  // ::kludge:: Should determine what classes exist, then remove them. Instead, removal of all known (hard-coded) classes.
	  presentationGroup.removeClass("landscapex3");
	  presentationGroup.removeClass("landscapex2");
	  presentationGroup.removeClass("portrait");
	  //presentationGroup.addClass( groupImages.layout );
	  presentationGroup.addClass( cvd.slides[presentationIndex].layout );
	  presentationGroupNext.removeClass("landscapex3");
	  presentationGroupNext.removeClass("landscapex2");
	  presentationGroupNext.removeClass("portrait");
	  //presentationGroupNext.addClass( groupImagesNext.layout );
	  presentationGroupNext.addClass( cvd.slides[nextIndex].layout );
	  presentationGroupNext.hide();
	  
	  // Set image attributes for members of each group.
	  // Old data method.
	  /*var images = getPresentationImages( presentationGroup );
	  images.image1.attr("src", groupImages.image1);
	  images.image2.attr("src", groupImages.image2);
	  images.image3.attr("src", groupImages.image3);
	  images = getPresentationImages( presentationGroupNext );
	  images.image1.attr("src", groupImagesNext.image1);
	  images.image2.attr("src", groupImagesNext.image2);
	  images.image3.attr("src", groupImagesNext.image3);*/
	  // New data method.
	  var images = getPresentationImages( presentationGroup );
	  // ::todo:: Check images array length to ensure that data exists.
	  images.image1.attr("src", groupImages[0].url);
	  images.image1.attr("title", groupImages[0].title);
	  images.image1.attr("alt", groupImages[0].caption);
	  images.image2.attr("src", groupImages[1].url);
	  images.image2.attr("title", groupImages[1].title);
	  images.image2.attr("alt", groupImages[1].caption);
	  images.image3.attr("src", groupImages[2].url);
	  images.image3.attr("title", groupImages[2].title);
	  images.image3.attr("alt", groupImages[2].caption);
	  images = getPresentationImages( presentationGroupNext );
	  images.image1.attr("src", groupImagesNext[0].url);
	  images.image1.attr("title", groupImagesNext[0].title);
	  images.image1.attr("alt", groupImagesNext[0].caption);
	  images.image2.attr("src", groupImagesNext[1].url);
	  images.image2.attr("title", groupImagesNext[1].title);
	  images.image2.attr("alt", groupImagesNext[1].caption);
	  images.image3.attr("src", groupImagesNext[2].url);
	  images.image3.attr("title", groupImagesNext[2].title);
	  images.image3.attr("alt", groupImagesNext[2].caption);
	  
	  // Set first text block.
	  // Deprecated: Independent text track method.
	  //jQuery("#ChallengeText").html(textGroups[textTrackIndex]);
	  // Text integrated with slide data method:
	  //var groupImages = cvd.slides[presentationIndex].images;
	  jQuery("#ChallengeText").html(cvd.slides[presentationIndex].text);
	  jQuery("#ChallengeText").hide();
	  jQuery("#ChallengeTextWrapper").removeClass("landscapex3");
	  jQuery("#ChallengeTextWrapper").removeClass("landscapex2");
	  jQuery("#ChallengeTextWrapper").removeClass("portrait");
	  jQuery("#ChallengeTextWrapper").addClass( cvd.slides[presentationIndex].layout );
	}
	
	
	// Called anytime audio begins playing.
	function audioStarted() {
		//alert("audio started");
		if (presentationState == "stopped" || presentationState == "complete") {
			// Condition at start. Audio has begin playing, so start the show.
			presentationState = "playing";
			startSlides();
		}
	}

	// Get playing interval pings from audio player. Unused.
	function audioProgress()
	{
	}
	
	// Called when audio playback completes.
	function audioCompleted() {
		endPresentation();
	}
	
	
	// Return image object array associated wth a given slide presentation grouping.
	function getPresentationImages( presentationGroup ) {
		if ( presentationGroup[0] === jQuery("#ChallengeGroupA")[0] ) {
		  return {image1:jQuery("#ChallengeImageA1Img"), image2:jQuery("#ChallengeImageA2Img"), image3:jQuery("#ChallengeImageA3Img")};
		} else {
		  return {image1:jQuery("#ChallengeImageB1Img"), image2:jQuery("#ChallengeImageB2Img"), image3:jQuery("#ChallengeImageB3Img")};
		} 
	}
	
	
	// Start the presentation from the beginning.
	function startPresentation() {
		//presentationState = "playing";
		// Start audio, and let the audio start callback begin the visual aspect of the presentation (startSlides).
		pfPlayAudio();
	}
	
	
	function endPresentation() {
		presentationState = "complete";
		// Halt all animations.
		var images1 = getPresentationImages( presentationGroup );
		var images2 = getPresentationImages( presentationGroupNext );
		images1.image1.pause();
		images1.image2.pause();
		images1.image3.pause();
		images2.image1.pause();
		images2.image2.pause();
		images2.image3.pause();
		jQuery("#ChallengeText").pause();
		// Fade out all content.
		jQuery("#ChallengeGroupA").fadeOut(animationDuration);
		jQuery("#ChallengeGroupB").fadeOut(animationDuration);
		jQuery("#ChallengeText").fadeOut(animationDuration);
		// Show title card, with replay button.
		jQuery("#ChallengeTitleBtn").attr("src", replayBtnImg);
		jQuery("#ChallengeTitle").hide().fadeIn(animationDuration);
	}
	
	
	// Start the visual aspect of the presentation.
	function startSlides() {
		// Fade out the title.
		jQuery("#ChallengeTitle").show().fadeOut(animationDuration);
		// Fade in the first image, and trigger fade in of rest of images.
		presentationGroup.show();
		var images = getPresentationImages( presentationGroup );
		// animate approach.
		// ::kludge:: jQuery has no provision to resume animate effects, so we use a custom pause js script to give us that.
		//   Pause will only work on objects with one animate effect placed on them, so we must use a series of dynamically
		//   chaining animate effects.
		//  - This will only work using animate.
		//	- This will not work if more than one item is chained to the fx chain.
		//  - This technique makes extensive use of "fake delays," setting animate on a property that does not change
		//   e.g. animate value from value to same value over a certain duration.
		images.image1.show();
		images.image1.css({ opacity: 0 });
		images.image2.show();
		images.image2.css({ opacity: 0 });
		images.image3.show();
		images.image3.css({ opacity: 0 });
		// Slide 1 fade in animations.
		// ::kludge:: tweak: Add delay to the first slide animations so it doesn't interfere too much with the title fade.
		// Delay corresponds to desired animation duration.
		var startOffset = animationDuration;
		images.image1.animate({opacity:0}, startOffset, function() {
			fadeMeIn(images.image1, animationDuration);
		});
		images.image2.animate({opacity:0}, startOffset+animationDuration, function() {
			fadeMeIn(images.image2, animationDuration);
		});
		images.image3.animate({opacity:0}, startOffset+animationDuration+animationDuration, function() {
			fadeMeIn(images.image3, animationDuration);
		});
		
		// Slide 2 delay animations. Remain invisible for length of slide 1.
		var images2 = getPresentationImages( presentationGroupNext );
		presentationGroupNext.show();
		images2.image1.show();
		images2.image1.css({ opacity: 0 });
		images2.image2.show();
		images2.image2.css({ opacity: 0 });
		images2.image3.show();
		images2.image3.css({ opacity: 0 });
		images2.image1.animate({opacity:0}, slideDuration, function() {
			// Slide 2 is now ready to display.
			advancePresentationIndex();
			fadeMeIn(images2.image1, animationDuration);
			if (useTextTrack == false) {
			  displayNextText();
			}		
		});
		images2.image2.animate({opacity:0}, slideDuration+animationDuration, function() {
			fadeMeIn(images2.image2, animationDuration);
		});
		images2.image3.animate({opacity:0}, slideDuration+animationDuration+animationDuration, function() {
			fadeMeInAndFinishSlide(images2.image3, animationDuration);
		});
		
		// Start text track animation.
		// Deprecated: Independent text track method:
		if (useTextTrack == true) {
		  var textObj = jQuery("#ChallengeText");
		  textObj.show();
		  textObj.css({ opacity: 0 });
		  var textTime1 = textTimeIntervals[textTrackIndex];
		  if (textTime1 == 0) {
			  // Display first text block immediately.
			  textObj.animate({opacity:1}, 1000, function() {
				  prepareNextText();
			  });
		  } else {
			  textObj.animate({opacity:0}, textTimeIntervals[0], function() {
				  jQuery("#ChallengeText").animate({opacity:1}, 1000, function() {
					  prepareNextText();
				  });
			  });
		  }
		} else {
		  // Text integrated into slide method:
		  var textObj = jQuery("#ChallengeText");
		  textObj.show();
		  textObj.css({ opacity: 0 });
		  textObj.animate({opacity:0}, startOffset, function() {
			  jQuery("#ChallengeText").animate({opacity:1}, animationDuration);
		  });
		}
	}
	
	
	function fadeMeIn(targetObj, duration) {
		if (presentationState == "playing") {
		  targetObj.animate({ opacity: 1 }, duration);
		}
	}
	
	function fadeMeInAndFinishSlide(targetObj, duration) {
		targetObj.animate({ opacity: 1 }, duration, function() {
			if (presentationState == "playing") {
			  finishSlide();
			}
		});
	}
	
	function displayNextText() {
		if (presentationIndex < cvd.slides.length) {
		  jQuery("#ChallengeText").animate({opacity:0}, animationDuration, function() {
			jQuery("#ChallengeText").html(cvd.slides[presentationIndex].text);
			jQuery("#ChallengeText").animate({opacity:1}, animationDuration);
			jQuery("#ChallengeTextWrapper").removeClass("landscapex3");
			jQuery("#ChallengeTextWrapper").removeClass("landscapex2");
			jQuery("#ChallengeTextWrapper").removeClass("portrait");
			jQuery("#ChallengeTextWrapper").addClass( cvd.slides[presentationIndex].layout );
		  });
		}
	}
	
	// Deprecated. Called after a slideshow text element has completed appearance (faded in).
	function prepareNextText() {
		// Deprecated: Independent text track method:
		var nextTextIndex = textTrackIndex+1;
		if (textGroups.length != nextTextIndex) {
			// Text appearance duration = time interval - time it takes to fade in previous text - time it takes to fade out previous text.
			var textDisplayDuration = textTimeIntervals[nextTextIndex] - 2000;
			jQuery("#ChallengeText").animate({opacity:1}, textDisplayDuration, function() {
				// Fade out text.
				jQuery("#ChallengeText").animate({opacity:0}, 1000, function() {
					showNextText();
				});
			});
		}
	}
	
	// Deprecated.
	function showNextText() {
		textTrackIndex++;
		if (textGroups.length >= textTrackIndex) {
			var nextText = textGroups[textTrackIndex];
			jQuery("#ChallengeText").html(nextText);
			jQuery("#ChallengeText").animate({opacity:1}, 1000, function() {
				prepareNextText();
			});
		}
	}
	
	function pausePresentation() {
		if (presentationState == "playing") {
		  presentationState = "paused";
		  // Halt all animations.
		  var images1 = getPresentationImages( presentationGroup );
		  var images2 = getPresentationImages( presentationGroupNext );
		  images1.image1.pause();
		  images1.image2.pause();
		  images1.image3.pause();
		  images2.image1.pause();
		  images2.image2.pause();
		  images2.image3.pause();
		  jQuery("#ChallengeText").pause();
		  // Display the Play button.
		  jQuery("#ChallengePausedImg").attr("src", playBtnImg);
		  jQuery("#ChallengePaused").stop(true).show();
		  jQuery("#ChallengePaused").css( {opacity:0.8} );
		  // Pause audio playback.
		  pfPauseAudio();
		}
	}
	
	function playPresentation() {
		switch (presentationState) {
			case "complete":
				// ::todo:: Replay presentation.
				break;
			case "paused":
				resumePresentation();
				break;
			case "stopped":
				startPresentation();
				break;
		}
	}
	
	function resumePresentation() {
		if (presentationState == "paused") {
		  presentationState = "playing";
			// Resume all animations.
		  var images1 = getPresentationImages( presentationGroup );
		  var images2 = getPresentationImages( presentationGroupNext );
		  images1.image1.resume();
		  images1.image2.resume();
		  images1.image3.resume();
		  images2.image1.resume();
		  images2.image2.resume();
		  images2.image3.resume();
		  jQuery("#ChallengeText").resume();
		  jQuery("#ChallengePaused").fadeOut(200);
		  pfPlayAudio();
		}
	}
	
	
	function resetPauseBtn() {
		jQuery("#ChallengePausedImg").attr("src", "./assets/images/challengeintro_pause.png");
		jQuery("#ChallengePaused").stop(true).show().delay(2000).fadeOut(800);
		//jQuery("#ChallengePaused").css( {opacity:0.8} );
	}
	
	
	function advancePresentationIndex() {
		presentationIndex++;
		if (presentationIndex == cvd.slides.length) {
			presentationIndex = 0;
		}
	}
	
	function finishSlide() {
		if (presentationState = "playing") {
		  // presentationGroup is the old group in back, presentationGroupNext is the new group in front.
		  presentationGroup.hide();
		  // Swap ordering.
		  presentationGroupNext.css("z-index",1);
		  presentationGroup.css("z-index",3);
		  presentationGroupNext.css("z-index",2);
		  // Swap groups (old presentationGroupNext is now the new presentationGroup, and old presentationGroup is now the new presentationGroupNext).
		  if ( presentationGroup[0] === jQuery("#ChallengeGroupA")[0] ) {
			  presentationGroup = jQuery("#ChallengeGroupB");
			  presentationGroupNext = jQuery("#ChallengeGroupA");
		  } else {
			  presentationGroup = jQuery("#ChallengeGroupA");
			  presentationGroupNext = jQuery("#ChallengeGroupB");
		  }
		  // Load in next set of images.
		  var presentationIndexNext = presentationIndex+1;
		  if (cvd.slides.length == presentationIndexNext) {
			  // Slides have run out. Show first slide again.
			  presentationIndexNext = 0;
		  }
		  //var groupImagesNext = cvd.images[presentationIndex];
		  var groupImagesNext = cvd.slides[presentationIndexNext].images;
		  
		   // ::kludge:: Should determine what classes exist, then remove them. Instead, removal of all known (hard-coded) classes.
		  presentationGroupNext.removeClass("landscapex3");
		  presentationGroupNext.removeClass("landscapex2");
		  presentationGroupNext.removeClass("portrait");
		  //presentationGroupNext.addClass( groupImagesNext.layout );
		  presentationGroupNext.addClass( cvd.slides[presentationIndexNext].layout );
		  
		  // Set image source for members of each group.
		  var images = getPresentationImages( presentationGroupNext );
		  /* images.image1.attr("src", groupImagesNext.image1);
		  images.image2.attr("src", groupImagesNext.image2);
		  images.image3.attr("src", groupImagesNext.image3); */
		  images.image1.attr("src", groupImagesNext[0].url);
		  images.image1.attr("title", groupImagesNext[0].title);
		  images.image1.attr("alt", groupImagesNext[0].caption);
		  images.image2.attr("src", groupImagesNext[1].url);
		  images.image2.attr("title", groupImagesNext[1].title);
		  images.image2.attr("alt", groupImagesNext[1].caption);
		  images.image3.attr("src", groupImagesNext[2].url);
		  images.image3.attr("title", groupImagesNext[2].title);
		  images.image3.attr("alt", groupImagesNext[2].caption);
		  	  
		  // Trigger next slide set animation.
		  presentationGroupNext.show();
		  images.image1.show();
		  images.image1.css({ opacity: 0 });
		  images.image2.show();
		  images.image2.css({ opacity: 0 });
		  images.image3.show();
		  images.image3.css({ opacity: 0 });
		  images.image1.animate({opacity:0}, slideDuration, function() {
		  	advancePresentationIndex();
			fadeMeIn(images.image1, animationDuration);
			if (useTextTrack == false) {
				displayNextText();
			}
		  });
		  images.image2.animate({opacity:0}, slideDuration+animationDuration, function() {
			  fadeMeIn(images.image2, animationDuration);
		  });
		  images.image3.animate({opacity:0}, slideDuration+animationDuration+animationDuration, function() {
			  fadeMeInAndFinishSlide(images.image3, animationDuration);
		  });
			
		}
	}

}); <!-- end document ready -->

function log(msg) {
  setTimeout(function() {
	  throw new Error(msg);
  }, 0);
}

function goToEditStepUrl() {
	window.location = "EditStep.php?Id=" + StepId;
	return false;
}

function goToViewStepsUrl() {
	window.location = "ViewSteps.php?ProjectId=" + ProjectId;
	return false;
}