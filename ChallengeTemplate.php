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
<script src="jquery-ui-1.8.23.custom/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<!-- <script src="jquery-ui-1.8.23.custom/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script> -->
<script src="_scripts/jquery.pause.min.js" type="text/javascript"></script>
<script src="_scripts/jQuery.jPlayer.2.2.0/jquery.jplayer.min.js" type="text/javascript"></script>
<script src="_scripts/challengeVideo.js" type="text/javascript"></script>
<script src="_scripts/challengeAudioSupportJPlayer.js" type="text/javascript"></script>
<!--
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
			
			if (true)
				urlLoadStep = "ChallengeIntroContent.html";
					
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
-->
<!--script type="text/javascript">

	function ribbonNavigationClick(url){
				document.getElementById('ContentScreensIframe').src = url;
		}	
		
</script-->
</head>
<body>
<?php include("Globals.php") ?>
<?php if ($PROJECTOR['editMode']) include("NavBar.php") ?>
<div class="gridContainer clearfix">
  <div id="Header">
    <div id="headerBackButton">
      <p><a href="ProjectDetails.php?Id=<?php echo $ProjectId?>">Back to Project Details</a></p>
    </div>
    <a href="index.php">
    <div id="headerLogo">
    <img src="_images/headerlogo@2x.png" alt="The Projector" width="48" height="24" />
      <p style="color:#FFF;">The Projector</p>
    </div>
    </a>
    <div id="headerChallengeTitle">
      <h1><?php echo $projectName; ?></h1>
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
  <div id="ContentScreens">

  	<!-- Content Gets dynamically placed here by calling the LoadStep function which uses LoadStep.php -->
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
