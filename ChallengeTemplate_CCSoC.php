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
<?php include("Globals.php") ?>
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
<title>Lesson :<?php echo $projectName; ?></title>
<link href="_css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="_css/ChallengeLayout_CCSoC.css" rel="stylesheet" type="text/css">
<link href="_css/ChallengeStyles.css" rel="stylesheet" type="text/css">
<link href="_css/ChallengeStyles_CCSoC.css" rel="stylesheet" type="text/css">
<link href="_css/RibbonStyles.css" rel="stylesheet" type="text/css">
<link href="_css/RibbonStyles_CCSoC.css" rel="stylesheet" type="text/css">
<link href="_css/ScreenStyles.css" rel="stylesheet" type="text/css">
<link href="_css/lessonTemplate_splash.css" rel="stylesheet" type="text/css">
<link href="_css/NavBar.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--<script type="text/javascript" src="//use.typekit.net/mpm3cdl.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->

<script src="js/utility.js"></script>
<script src="_scripts/respond.min.js"></script>
<script src="jquery-ui-1.8.23.custom/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="_scripts/jquery.pause.min.js" type="text/javascript"></script>
<script src="_scripts/jQuery.jPlayer.2.2.0/jquery.jplayer.min.js" type="text/javascript"></script>
<script src="_scripts/modernizr.custom.42097.js"></script>
<script src="_scripts/challengeVideo_CCSoC.js" type="text/javascript"></script>
<script src="_scripts/challengeAudioSupportJPlayer.js" type="text/javascript"></script>
<script src="_scripts/challengeTablet.js"></script>

<script type="text/javascript">
	$(document).ready(function(){ 
	
		jQuery("#TeacherNotes-Info-CC").click(function(){
			$('#TeacherNotes-Text-CC').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
			$('#TeacherNotes-Info-CC').css({'display':'none'});
			$('#TeacherNotes-Close-CC').css({'display':'block'}); 
			return false;
		});
	
		jQuery("#TeacherNotes-Close-CC").click(function(){
			$('#TeacherNotes-Text-CC').css({'visibility':'hidden'});
			$('#TeacherNotes-Info-CC').css({'display':'block'});
			$('#TeacherNotes-Close-CC').css({'display':'none'});
			return false;
		});
	
	});
</script>

</head>
<body style="overflow-x:hidden">
<?php if ($PROJECTOR['editMode']) include("NavBar.php") ?>
<div class="gridContainer clearfix">
  <div id="Header">
    <div id="headerBackButton-CC">
      <a href="ProjectDetails.php?Id=<?php echo $ProjectId?>">Back to Lesson Details</a>
    </div>
    <a href="index.php">
    <div id="headerLogo">
    <img src="_images/headerlogo@2x.png" alt="The Projector" width="48" height="24" />
      <p style="color:#FFF;">Common Core Lessons</p>
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
        <div id="leftButton-CC"></div>
        <div id="rightButton-CC"></div>
        <div id="ribbonStrip">
          <div id="ribbonButtons" ontouchstart="touchStart(event,'ribbonButtons');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);">
            <?php require_once("RibbonDynamicContent.php") ?>
          </div>
        </div>
        <!-- NavRibbon Ends --> 
      </div>
    </div>
    <div id="NavShadowDiv"></div>
  </div>
  <input id="numberSteps" type="hidden" value="<?php echo $totalRows_stepsRecordset; ?>" />
  <div id="ContentScreens" ontouchend="touchEnd(event);" >
    <div id="ContentScreensHolder"> 
      <!-- Content Gets dynamically placed here by calling the LoadStep function which uses LoadStep.php --> 
    </div>
  </div>
  <div id="ContentScreensLoader">
    <div id="floatingCirclesG">
      <div class="f_circleG" id="frotateG_01"> </div>
      <div class="f_circleG" id="frotateG_02"> </div>
      <div class="f_circleG" id="frotateG_03"> </div>
      <div class="f_circleG" id="frotateG_04"> </div>
      <div class="f_circleG" id="frotateG_05"> </div>
      <div class="f_circleG" id="frotateG_06"> </div>
      <div class="f_circleG" id="frotateG_07"> </div>
      <div class="f_circleG" id="frotateG_08"> </div>
    </div>
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
