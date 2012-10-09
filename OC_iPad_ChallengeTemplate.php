<?php require_once('Connections/projector.php'); ?>
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


$StepNumber = 1;

$ProjectId = -1;
if (isset($_GET['ProjectId'])) {
	$ProjectId = $_GET['ProjectId'];
}

mysql_select_db($database_projector, $projector);
$query_projectName = sprintf("SELECT Name FROM projects WHERE Id = %s", GetSQLValueString($ProjectId, "int"));
$projectNameResults = mysql_query($query_projectName, $projector) or die(mysql_error());
$row_projectName = mysql_fetch_assoc($projectNameResults);
$projectName = "";
if (isset($row_projectName['Name']))
	$projectName = $row_projectName['Name'];
$totalRows_projectName = mysql_num_rows($projectNameResults);

?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Challenge : <?php echo $projectName; ?></title>
<link href="_css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="_css/ChallengeLayout.css" rel="stylesheet" type="text/css">
<link href="_css/ChallengeStyles.css" rel="stylesheet" type="text/css">
<link href="_css/RibbonStyles.css" rel="stylesheet" type="text/css">
<link href="_css/ScreenStyles.css" rel="stylesheet" type="text/css">
<link href="_css/NavBar.css" rel="stylesheet" type="text/css" />

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--<script type="text/javascript" src="//use.typekit.net/mpm3cdl.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->

<script src="js/utility.js"></script>
<script src="_scripts/respond.min.js"></script>
<script src="_scripts/jquery.js" type="text/javascript"></script>

<script type="text/javascript">
	// From the URL get the ProjectId if it is defined otherwise default to ProjectId of -1
	var ProjectId = getQueryVariable("ProjectId", -1);
	var StepId = getQueryVariable("StepId", -1);
	var StepNumber = getQueryVariable("StepNumber", 1);
	
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
			});
		}
		
		
	});
	
	function goToEditStepUrl() {
		window.location = "EditStep.php?Id=" + StepId;
		return false;
	}
	
	function goToViewStepsUrl() {
		window.location = "ViewSteps.php?ProjectId=" + ProjectId;
		return false;
	}
</script>
<!--script type="text/javascript">

	function ribbonNavigationClick(url){
				document.getElementById('ContentScreensIframe').src = url;
		}	
		
</script-->
<script type="text/javascript">
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
			// get the coordinates of the touch
			startX = event.touches[0].pageX;
			startY = event.touches[0].pageY;
			// store the triggering element ID
			triggerElementID = passedName;
		} else {
			// more than one finger touched so cancel
			touchCancel(event);
		}
	}

	function touchMove(event) {
		event.preventDefault();
		if ( event.touches.length == 1 ) {
			curX = event.touches[0].pageX;
			curY = event.touches[0].pageY;
		} else {
			touchCancel(event);
		}
	}
	
	function touchEnd(event) {
		event.preventDefault();
		// check to see if more than one finger was used and that there is an ending coordinate
		if ( fingerCount == 1 && curX != 0 ) {
			// use the Distance Formula to determine the length of the swipe
			swipeLength = Math.round(Math.sqrt(Math.pow(curX - startX,2) + Math.pow(curY - startY,2)));
			// if the user swiped more than the minimum length, perform the appropriate action
			if ( swipeLength >= minLength ) {
				caluculateAngle();
				determineSwipeDirection();
				processingRoutine();
				touchCancel(event); // reset the variables
			} else {
				touchCancel(event);
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
		if ( swipeDirection == 'left' ) {
			// REPLACE WITH YOUR ROUTINES
			swipedElement.style.backgroundColor = 'orange';
			console.log("swipe left");
			alert('swipe left');
			StepNumber--;
			loadStep(-1,StepNumber);
		} else if ( swipeDirection == 'right' ) {
			// REPLACE WITH YOUR ROUTINES
			console.log("swipe left");
				alert('swipe right');
			StepNumber++;
			loadStep(-1,StepNumber);
			swipedElement.style.backgroundColor = 'green';
		} else if ( swipeDirection == 'up' ) {
			// REPLACE WITH YOUR ROUTINES
			swipedElement.style.backgroundColor = 'maroon';
		} else if ( swipeDirection == 'down' ) {
			// REPLACE WITH YOUR ROUTINES
			swipedElement.style.backgroundColor = 'purple';
		}
	}

</script>
</head>
<body style="background-image: url(_images/challenge/OC_challenge_bg.png);">
<div class="gridContainer clearfix">
  <div id="Header" style="height: 50px">
    <div id="headerLogo"> <img src="_images/headerlogo@2x.png" alt="The Projector" width="48" height="24">
      <p>The Projector</p>
    </div>
  </div>
  <div id="RibbonNavigation">
    <div id="NavRibbonDiv"> 
     
      <!-- NavRibbon Starts -->
      <div id="ribbonContainer">
        <div id="leftButton"> </div>
        <div id="rightButton"> </div>
        <div id="ribbonStrip">
          <div id="ribbonButtons">
            <?php require_once("RibbonDynamicContent.php") ?>
          </div>
        </div>
        <!-- NavRibbon Ends --> 
      </div>
    </div>
    <div id="NavShadowDiv"></div>
  </div>
  <div id="ContentScreens" ontouchstart="touchStart(event,'ContentScreens');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);">
   	<!--iframe src="ChallengeRibbon.html" frameborder="0" height="120" width="100%" allowtransparency="yes" scrolling="no"></iframe--> 
    <!-- Note: iFrame width not respected on tablets - bursts and shows all overflow content --> 
    <!--<iframe id="ContentScreensIframe" src="" frameborder="0" width="100%" height="1000px" allowtransparency="yes" scrolling="no"></iframe>-->
  </div>
  <div id="Footer">
    <p></p>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($projectNameResults);
?>
